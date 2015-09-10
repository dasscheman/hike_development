<?php
// Created: 2014
// Modified: 18 jan 2015

class QrController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('deny',  // deny all guest users
				'users'=>array('?'),),
			array(	'allow', // only when $_GET are set
					'actions'=>array('moveUpDown'),
					'expression'=> 'Qr::model()->isActionAllowed(
						Yii::app()->controller->id,
						Yii::app()->controller->action->id,
						$_GET["event_id"],
						$_GET["qr_id"],
						"",
						$_GET["date"],
						$_GET["volgorde"],
						$_GET["up_down"])'),
            array(	'allow', // allow admin user to perform 'viewplayers' actions
                    'actions'=>array('index', 'update', 'delete', 'create', 'report', 'createIntroductie'),
                    'expression'=> 'Qr::model()->isActionAllowed(
                        Yii::app()->controller->id,
                        Yii::app()->controller->action->id,
                        $_GET["event_id"])'),
			array('deny',  // deny all users
				'users'=>array('*'),),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Qr;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Qr']))
		{

			$model->qr_code = Qr::model()->getUniqueQrCode();
			$model->event_ID = $_GET['event_id'];
			$model->route_ID = $_GET['route_id'];
			$model->qr_volgorde = Qr::model()->getNewOrderForQr($_GET['event_id'], $_GET['route_id']);
			$model->attributes=$_POST['Qr'];
			if($model->save())
				$this->redirect(array(
					'/route/view',
					'event_id'=>$model->event_ID,
					'route_id'=>$model->route_ID));
		}
		$this->layout='/layouts/column1';
		$this->render('create',
					  array('model'=>$model,
		));
	}

	public function actioncreateIntroductie()
	{
		$model = new Qr;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_GET['event_id']))
		{
			$model->qr_name = "Introductie";
			$model->qr_code = Qr::model()->getUniqueQrCode();
			$model->event_ID = $_GET['event_id'];
			$model->route_ID = Route::model()-> getIntroductieRouteId($_GET['event_id']);
			$model->qr_volgorde = Qr::model()->getNewOrderForIntroductieQr($_GET['event_id']);
			$model->score = 5;

			if($model->save());
			{
				$this->redirect(array('route/viewIntroductie','event_id'=>$_GET['event_id']));
			}
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
		$qr_id = $_GET['qr_id'];
		$model=$this->loadModel($qr_id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Qr']))
		{
			$model->attributes=$_POST['Qr'];
			if($model->save())
				if( Route::model()->routeIdIntroduction($model->route_ID) ){
					$this->redirect(array('/route/viewIntroductie',
							'route_id'=>$model->route_ID,
							'event_id'=>$model->event_ID));
				} else {
					$this->redirect(array('/route/view',
							'route_id'=>$model->route_ID,
							'event_id'=>$model->event_ID));
				}
		}
		$this->layout='/layouts/column1';
		$this->render('update',
					  array('model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete()
	{
		$qr_id = $_GET['qr_id'];
		try
		{
			$this->loadModel($qr_id)->delete();
		}
		catch(CDbException $e)
		{
			throw new CHttpException(400,"Je kan deze stille post niet verwijderen.");
		}

		if (Route::model()->routeIdIntroduction($_GET['route_id'])){
			$this->redirect(isset($_POST['returnUrl']) ?
					$_POST['returnUrl'] : array('/route/viewIntroductie',
									'event_id'=>$_GET['event_id'],
									'route_id'=>$_GET['route_id']));
		} else {
			$this->redirect(isset($_POST['returnUrl']) ?
					$_POST['returnUrl'] : array('/route/view',
									'event_id'=>$_GET['event_id'],
									'route_id'=>$_GET['route_id']));
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$event_id = $_GET['event_id'];
		$where = "event_ID = $event_id";

		$dataProvider=new CActiveDataProvider('Qr',
		    array(
			'criteria'=>array(
			    'condition'=>$where,
			    'order'=>'route_ID ASC, qr_volgorde ASC',
			    ),
			'pagination'=>array(
				'pageSize'=>15,
			),
		));


		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Qr('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Qr']))
			$model->attributes=$_GET['Qr'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}


	public function actionReport()
	{
		$id = $_GET['id'];
		$this->renderPartial("reportview", $id);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Qr the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Qr::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Qr $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='qr-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionMoveUpDown()
    {
		$event_id = $_GET['event_id'];
		$qr_id = $_GET['qr_id'];
		$qr_volgorde = $_GET['volgorde'];
		$up_down = $_GET['up_down'];
		$route_id = Qr::model()->getQrRouteID($qr_id);

		$currentModel = Qr::model()->findByPk($qr_id);

		$criteria = new CDbCriteria;

		if ($up_down=='up')
		{
			$criteria->condition = 'event_ID =:event_id AND
									qr_ID !=:id AND
									route_ID=:route_id AND
									qr_volgorde <=:order';
			$criteria->params=array(':event_id' => $event_id,
									':id' => $qr_id,
									':route_id' => $route_id ,
									':order' => $qr_volgorde);
			$criteria->order= 'qr_volgorde DESC';
		}
		if ($up_down=='down')
		{
			$criteria->condition = 'event_ID =:event_id AND
									qr_ID !=:id AND
								 	route_ID=:route_id AND
									qr_volgorde >:order';
			$criteria->params=array(':event_id' => $event_id,
									':id' => $qr_id,
									':route_id' => $route_id ,
									':order' => $qr_volgorde);
			$criteria->order= 'qr_volgorde ASC';
		}
			$criteria->limit=1;
		$previousModel = Qr::model()->find($criteria);

		$tempCurrentVolgorde = $currentModel->qr_volgorde;
		$currentModel->qr_volgorde = $previousModel->qr_volgorde;
		$previousModel->qr_volgorde = $tempCurrentVolgorde;

		$currentModel->save();
		$previousModel->save();

		if (Route::model()->routeIdIntroduction($currentModel->route_ID))
		{
			$this->redirect(array('route/viewIntroductie',
				"route_id"=>$currentModel->route_ID,
				"event_id"=>$currentModel->event_ID,));
		}
		else
		{
			$this->redirect(array('route/view',
				"route_id"=>$currentModel->route_ID,
				"event_id"=>$currentModel->event_ID,));
		}
	}
}
