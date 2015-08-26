<?php
// Created: 2014
// Modified: 26 jan 2015

class QrCheckController extends Controller
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
				'users'=>array('?'),
			),
			array(	'deny',  // deny if group_id is not set
				'actions'=>array('create', 'update'),
				'expression'=> '!isset($_GET["qr_code"])',
			),
			array(	'deny',  // deny if group_id is not set
				'actions'=>array('update', 'viewPlayers'),
				'expression'=> '!isset($_GET["group_id"])',
			),
            array(	'allow', // allow admin user to perform 'viewplayers' actions
                'actions'=>array('index', 'update', 'delete', 'create'),
                'expression'=> 'QrCheck::model()->isActionAllowed(
                    Yii::app()->controller->id,
                    Yii::app()->controller->action->id,
                    $_GET["event_id"])',
            ),
            array(	'allow', // allow admin user to perform 'viewplayers' actions
                'actions'=>array('viewPlayers'),
                'expression'=> 'QrCheck::model()->isActionAllowed(
                    Yii::app()->controller->id,
                    Yii::app()->controller->action->id,
                    $_GET["event_id"],
					$_GET["group_id"])',
            ),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
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
		$qr_code = $_GET['qr_code'];
		$event_id = $_GET['event_id'];
		$groupPlayer = DeelnemersEvent::model()->getGroupOfPlayer($event_id,
									  Yii::app()->user->id);

		$model=new QrCheck;

		$qr = Qr::model()->find('event_ID =:event_id AND
					 qr_code =:qr_code',
				  array(':event_id' => $event_id,
				        ':qr_code'  => $qr_code));
		if (!isset($qr->qr_code)){
			throw new CHttpException(403,"Ongeldige QR code.");
		}

		$qrCheck = QrCheck::model()->find('event_ID =:event_id AND qr_ID =:qr_id AND group_ID =:group_id',
									array(':event_id' => $qr->event_ID,
										  ':qr_id'  => $qr->qr_ID,
										  ':group_id'  => $groupPlayer));
		if (isset($qrCheck->qr_check_ID)){
			throw new CHttpException(403,"Jullie groep heeft deze code al gescand");
		}

		$model->qr_ID = $qr->qr_ID;
		$model->event_ID = $qr->event_ID;
		$model->group_ID = $groupPlayer;

		if($model->save())
			$this->redirect(array('viewPlayers','event_id'=>$model->event_ID,
							  'group_id'=>$model->group_ID));



		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
/*
		if(isset($_POST['QrCheck']))
		{
			$model->attributes=$_POST['QrCheck'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->qr_check_ID));
		}

		$this->render('create',array(
			'model'=>$model,
		));*/
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['QrCheck']))
		{
			$model->attributes=$_POST['QrCheck'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->qr_check_ID));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$event_id = $_GET['event_id'];
		$where = "event_ID = $event_id";

		$dataProvider=new CActiveDataProvider('QrCheck',
			array('criteria'=>array(
					'condition'=>$where,
					'order'=>'create_time DESC',
						),
				'pagination'=>array('pageSize'=>20,),
			)
		);

		$this->layout='//layouts/column1';
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new QrCheck('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['QrCheck']))
			$model->attributes=$_GET['QrCheck'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionViewPlayers()
	{
		$event_id = $_GET['event_id'];
		$group_id = $_GET['group_id'];

		//$day_id = EventNames::model()->getActiveDayOfHike($event_id);

		$where = "event_ID = $event_id AND group_ID = $group_id";
		$qrCheckDataProvider=new CActiveDataProvider('QrCheck',
		    array(
			'criteria'=>array(
			    'condition'=>$where,
			    'order'=>'qr_check_ID DESC',
			    ),
			'pagination'=>array(
			    'pageSize'=>40,
			),
		));
		$this->render('viewPlayers',array(
			'qrCheckDataProvider'=>$qrCheckDataProvider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return QrCheck the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=QrCheck::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param QrCheck $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='qr-check-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
