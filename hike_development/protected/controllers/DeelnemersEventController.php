<?php
// Created: 2014
// Modified: 20 feb 2015

class DeelnemersEventController extends Controller
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('dynamicrol'),
				'users'=>array('@'),
			),			
			array(	'deny',  // deny if group_id is not set
				'actions'=>array('index','view'),
				'expression'=> '!isset($_GET["group_id"])',
			),			
			array(	'allow', // allow admin user to perform 'viewplayers' actions
				'actions'=>array('index', 'view', 'update', 'delete', 'viewPlayers', 'create'),
				'expression'=> 'DeelnemersEvent::model()->isActionAllowed(
                    Yii::app()->controller->id,
                    Yii::app()->controller->action->id,
                    $_GET["event_id"])',
			),
			array('deny', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('adminCreate'),
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
		$this->render('view',array('model'=>$this->loadModel($id)));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new DeelnemersEvent;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DeelnemersEvent']))
		{
			$model->attributes=$_POST['DeelnemersEvent'];
			if($model->save())
				//$this->redirect(array('view','id'=>$model->deelnemers_ID));
				$this->redirect(array('/startup/startupOverview',
						      'event_id'=>$model->event_ID));
		
		}

		$this->layout='//layouts/column1';
		$this->render('create',array('model'=>$model));
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAdminCreate()
	{
		$model=new DeelnemersEvent;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DeelnemersEvent']))
		{
			$model->attributes=$_POST['DeelnemersEvent'];
			if($model->save())
				//$this->redirect(array('view','id'=>$model->deelnemers_ID));
				$this->redirect(array('eventNames/index'));
		
		}

		$this->render('create',array(
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

		if(isset($_POST['DeelnemersEvent']))
		{
			$model->attributes=$_POST['DeelnemersEvent'];
			if($model->save())
				//$this->redirect(array('view','id'=>$model->deelnemers_ID));
				$this->redirect(array('/startup/startupOverview',
						      'event_id'=>$model->event_ID));
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
		try
		{
			$this->loadModel($id)->delete();
		}
		catch(CDbException $e)
		{		
			throw new CHttpException(400,"Je kan deze deelnemer niet verwijderen.");
		}
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/startup/startupOverview',
												 'event_id'=>$_GET['event_id']));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('DeelnemersEvent');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new DeelnemersEvent('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DeelnemersEvent']))
			$model->attributes=$_GET['DeelnemersEvent'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return DeelnemersEvent the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=DeelnemersEvent::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param DeelnemersEvent $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='deelnemers-event-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
  
  	/*
	 * Deze actie wordt gebruikt voor de form velden. Op basis van een hike
	 * en een dag wordt bepaald welke posten er beschikbaar zijn. 
	 */
	public function actionDynamicRol()
	{
		if($_POST['rol']==3)
		{
			$data = Groups::model()->getGroupOptionsForEvent($_POST['event_id']);
			foreach($data as $value=>$name)
			{
				echo CHtml::tag('option', array('value'=>$value), CHtml::encode($name),true);
			}
		}
	}
}
