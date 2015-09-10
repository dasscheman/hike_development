<?php
// Created: 2014
// Modified: 3 jan 2015

class BonuspuntenController extends Controller
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
			array(	'deny',  // deny all guest users
				'users'=>array('?'),
			),
			array(	'allow', // dynamic action should always be allowed
				'actions'=>array('dynamicpostid'),
				'users'=>array('@'),
			),
			array(	'deny',  // deny if group_id is not set
				'actions'=>array('viewPlayers'),
				'expression'=> '!isset($_GET["group_id"])',
			),
			array(	'allow', // allow admin user to perform 'viewplayers' actions
				'actions'=>array('index', 'update', 'delete', 'create'),
				'expression'=> 'Bonuspunten::model()->isActionAllowed(
                    Yii::app()->controller->id,
                    Yii::app()->controller->action->id,
                    $_GET["event_id"])',
			),
			array(	'allow', // allow admin user to perform 'viewplayers' actions
				'actions'=>array('viewPlayers'),
				'expression'=> 'Bonuspunten::model()->isActionAllowed(
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Bonuspunten;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Bonuspunten']))
		{
			$model->attributes=$_POST['Bonuspunten'];
			if($model->save())
				$this->redirect(array('/bonuspunten/index',
						      'event_id'=>$model->event_ID));;
		}

		$this->layout='//layouts/column1';
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

		if(isset($_POST['Bonuspunten']))
		{
			$model->attributes=$_POST['Bonuspunten'];
			if($model->save())
				$this->redirect(array('/game/groupOverview',
						      'event_id'=>$model->event_ID,
						      'group_id'=>$model->group_ID));
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
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/game/groupOverview',
												 'event_id'=>$model->event_ID,
												 'group_id'=>$model->group_ID));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$event_id = $_GET['event_id'];
		$where = "event_ID = $event_id";

		$dataProvider=new CActiveDataProvider('Bonuspunten',
		    array(
			'criteria'=>array(
			    'condition'=>$where,
			    //'order'=>'group_ID DESC',
			    ),
			'pagination'=>array(
			    'pageSize'=>10,
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
		$model=new Bonuspunten('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Bonuspunten']))
			$model->attributes=$_GET['Bonuspunten'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionViewPlayers()
	{
		$event_Id = $_GET['event_id'];
		$group_id = $_GET['group_id'];

		$testwhere = "event_ID = $event_Id AND group_ID = $group_id";
		$bonuspuntenDataProvider=new CActiveDataProvider('Bonuspunten',
		    array(
			 'criteria'=>array(
				'condition'=>$testwhere,
			  ),
			'pagination'=>array(
			    'pageSize'=>10,
			),
		));
		$this->layout='//layouts/column1';
		$this->render('viewPlayers',array(
			'bonuspuntenDataProvider'=>$bonuspuntenDataProvider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Bonuspunten the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Bonuspunten::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Bonuspunten $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='bonuspunten-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/*
	 * Deze actie wordt gebruikt voor de form velden. Op basis van een hike
	 * en een dag wordt bepaald welke posten er beschikbaar zijn.
	 * TODO: Deze functie wordt vaker gebruikt, dus zou op een
	 * generieke plek moeten komen.
	 */
	public function actionDynamicPostId()
	{
		$date =  date("Y-m-d", $_POST['date']);
		$event_id = $_POST['event_id'];

		$data=Posten::model()->findAll('date =:date AND event_ID =:event_id',
					       array(':date'=>$date,
						     ':event_id'=>$event_id));
	   	$mainarr = array();

		foreach($data as $obj)
		{
			//De post naam moet gekoppeld worden aan de post_id:
			$mainarr["$obj->post_ID"] = Posten::model()->getPostName($obj->post_ID);
		}

		// Een leeg veld moet mogelijk zijn bij het invoeren van bonuspunten.
		echo CHtml::tag('option',array('value' => ''),'Posten niet van toepassing...',true);
		foreach($mainarr as $value=>$name)
		{
		    echo CHtml::tag('option', array('value'=>$value), CHtml::encode($name),true);
		}
	}
}
