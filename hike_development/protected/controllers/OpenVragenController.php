<?php
// Created: 2014
// Modified: 18 jan 2015

class OpenVragenController extends Controller
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
			array('deny',  // deny all users
				'users'=>array('?'),
			),
			array(	'allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('dynamicRouteOnderdeel'),
				'users'=>array('@'),
			),
			array(	'deny',  // deny if event_id is not set
				'actions'=>array('delete'),
				'expression'=> '!isset($_GET["vraag_id"])',
			),
			array(	'deny',  // deny if event_id is not set
				'actions'=>array('create'),
				'expression'=> '!isset($_GET["route_id"])',
			),
			array(	'allow', // only when $_GET are set
				'actions'=>array('moveUpDown'),
				'expression'=> 'OpenVragen::model()->isActionAllowed(
					Yii::app()->controller->id,
					Yii::app()->controller->action->id,
					$_GET["event_id"],
					$_GET["vraag_id"],
					"",
					$_GET["date"],
					$_GET["volgorde"],
					$_GET["up_down"])'),
            array(	'allow', // allow admin user to perform 'viewplayers' actions
                'actions'=>array('update', 'delete', 'create', 'view', 'createIntroductie', 'index'),
                'expression'=> 'OpenVragen::model()->isActionAllowed(
                    Yii::app()->controller->id,
                    Yii::app()->controller->action->id,
                    $_GET["event_id"])',
            ),
			array(	'allow', // allow admin user to perform 'viewplayers' actions
                'actions'=>array('viewPlayers'),
                'expression'=> 'OpenVragen::model()->isActionAllowed(
                    Yii::app()->controller->id,
                    Yii::app()->controller->action->id,
                    $_GET["event_id"],
					"",
					$_GET["group_id"])',
            ),
			array(	'deny',  // deny all users
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



	public function actionViewPlayers()
	{
		$event_id = $_GET['event_id'];
		/**
		 * Alleen de vragen van een active dag van een gestarte hike
		 * kunnen worden getoond. Er worden exeptions gezet als niet
		 * voldaan wordt.
		 */

		if (EventNames::model()->getStatusHike($event_id) == EventNames::STATUS_introductie) {
			$openVragenDataProvider=new CActiveDataProvider('OpenVragen',
				array(
					'criteria'=>array(
						 'join'=>'JOIN tbl_route route ON route.route_ID = t.route_ID',
						 'condition'=>'route.route_name =:name
										AND route.event_ID =:event_id',
						 'params'=>array(':name'=>'Introductie',
										  ':event_id'=>$event_id),
						 'order'=>'route_ID ASC, vraag_volgorde ASC'
						),
					'pagination'=>array(
						'pageSize'=>30,
					),
				)
			);
		} else {
			$active_day = EventNames::model()->getActiveDayOfHike($event_id);
			$openVragenDataProvider=new CActiveDataProvider('OpenVragen',
				array(
					'criteria'=>array(
						 'join'=>'JOIN tbl_route route ON route.route_ID = t.route_ID',
						 'condition'=>'route.day_date =:active_day
										AND route.event_ID =:event_id',
						 'params'=>array(':active_day'=>$active_day,
										  ':event_id'=>$event_id),
						 'order'=>'route_ID ASC, vraag_volgorde ASC'
						),
					'pagination'=>array(
						'pageSize'=>30,
					),
				)
			);
		}

		$this->layout='//layouts/column1';
		$this->render('viewPlayers',array(
			'openVragenDataProvider'=>$openVragenDataProvider,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new OpenVragen;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['OpenVragen']))
		{
			$model->attributes=$_POST['OpenVragen'];


			$model->event_ID = $_GET['event_id'];
			$model->route_ID = $_GET['route_id'];
			$model->vraag_volgorde = OpenVragen::model()->getNewOrderForVragen(
				$_GET['event_id'],
				$_GET['route_id']);

			if($model->save())
				$this->redirect(array(
					'/route/view',
					'event_id'=>$model->event_ID,
					'route_id'=>$model->route_ID));
		}
		$this->layout='/layouts/column1';
		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionCreateIntroductie()
	{
		$model=new OpenVragen;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['OpenVragen']))
		{
			$model->attributes=$_POST['OpenVragen'];
			$model->event_ID = $_GET['event_id'];
			$model->route_ID = Route::model()-> getIntroductieRouteId($_GET['event_id']);
			$model->vraag_volgorde = OpenVragen::model()->getNewOrderForIntroductieVragen($_GET['event_id']);

			if($model->save())
				$this->redirect(array('/route/viewIntroductie', 'event_id'=>$model->event_ID));
		}
		$this->layout='/layouts/column1';
		$this->render('createIntroductie',array(
			'model'=>$model,
		));
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

		if(isset($_POST['OpenVragen']))
		{
			$model->attributes=$_POST['OpenVragen'];
			if($model->save())
				if (Route::model()->routeIdIntroduction($model->route_ID)){
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
		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete()
	{
		try
		{
			$this->loadModel($_GET['vraag_id'])->delete();
		}
		catch(CDbException $e)
		{
			throw new CHttpException(400,"Je kan deze vraag niet verwijderen.");
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
		$vragenData=new OpenVragen();

		$this->layout='//layouts/column1';

		$this->render('index',array(
			'vragenData'=>$vragenData,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new OpenVragen('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['OpenVragen']))
			$model->attributes=$_GET['OpenVragen'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return OpenVragen the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=OpenVragen::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param OpenVragen $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='open-vragen-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/*
	 * Deze actie wordt gebruikt voor de form velden. Op basis van een hike
	 * en een dag wordt bepaald welke route onderdelen er beschikbaar zijn.
	 * Returns list with available techniek names, for a day and event.
	 */
	public function actionDynamicRouteOnderdeel()
	{
		$day_id = $_POST['day_id'];
		$event_id = $_POST['event_id'];
		$data = Route::model()->findAll('day_ID =:day_id AND event_ID =:event_id',
						array(':day_id'=>$day_id,
						      ':event_id'=>$event_id));
		$mainarr = array();

		foreach($data as $obj)
		{
			//De post naam moet gekoppeld worden aan de post_id:
			$mainarr["$obj->route_techniek_ID"] = RouteTechniek::model()->getRouteTechniekName($obj->route_techniek_ID);
		}

		foreach($mainarr as $value=>$name)
		{
			echo CHtml::tag('option', array('value'=>$value), CHtml::encode($name),true);
		}
	}

	public function actionMoveUpDown()
    {
		$event_id = $_GET['event_id'];
		$vraag_id = $_GET['vraag_id'];
		$vraag_volgorde = $_GET['volgorde'];
		$up_down = $_GET['up_down'];
		$route_id = OpenVragen::model()->getRouteIdVraag($vraag_id);
		$currentModel = OpenVragen::model()->findByPk($vraag_id);
		$criteria = new CDbCriteria;

		if ($up_down=='up')
		{
			$criteria->condition = 'event_ID =:event_id AND
									open_vragen_ID !=:id AND
									route_ID=:route_id AND
									vraag_volgorde <=:order';
			$criteria->params=array(':event_id' => $event_id,
									':id' => $vraag_id,
									':route_id' => $route_id,
									':order' => $vraag_volgorde);
			$criteria->order= 'vraag_volgorde DESC';
		}
		if ($up_down=='down')
		{
			$criteria->condition = 'event_ID =:event_id AND
									open_vragen_ID !=:id AND
									route_ID=:route_id AND
									vraag_volgorde >=:order';
			$criteria->params=array(':event_id' => $event_id,
									':id' => $vraag_id,
									':route_id' => $route_id,
									':order' => $vraag_volgorde);
			$criteria->order= 'vraag_volgorde ASC';
		}
		$criteria->limit=1;
		$previousModel = OpenVragen::model()->find($criteria);

		$tempCurrentVolgorde = $currentModel->vraag_volgorde;
		$currentModel->vraag_volgorde = $previousModel->vraag_volgorde;
		$previousModel->vraag_volgorde = $tempCurrentVolgorde;

		$currentModel->save();
		$previousModel->save();

		if (Route::model()->routeIdIntroduction($currentModel->route_ID))
		{
			$this->redirect(array('route/viewIntroductie',
			"route_id"=>$currentModel->route_ID,
			"event_id"=>$currentModel->event_ID));
		}
		else
		{
			$this->redirect(array('route/view',
			"route_id"=>$currentModel->route_ID,
			"event_id"=>$currentModel->event_ID,));
		}
	}
}
