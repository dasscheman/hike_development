<?php
// Created: 2014
// Modified: 11 jan 2015

class PostenController extends Controller
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
			// Vanuit de view 'index'wordt er gebruik gemaakt van een GET request om te deleten.
			// Daarom is het volgende stuk uitgepijpt.
			//'postOnly + delete', // we only allow deletion via POST request
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
				'users'=>array('?'),),
			array(	'allow', // only when $_GET are set
					'actions'=>array('moveUpDown'),
					'expression'=> 'Posten::model()->isActionAllowed(
						Yii::app()->controller->id,
						Yii::app()->controller->action->id,
						$_GET["event_id"],
						"",
						"",
						$_GET["date"],
						$_GET["volgorde"],
						$_GET["up_down"])'
			),
            array(	'allow', // allow admin user to perform 'viewplayers' actions
                'actions'=>array('index', 'update', 'delete', 'create', 'view'),
                'expression'=> 'Posten::model()->isActionAllowed(
                    Yii::app()->controller->id,
                    Yii::app()->controller->action->id,
                    $_GET["event_id"])',
            ),
			array('deny',  // deny all users
				'users'=>array('*'),),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView()
	{
		$post_id = $_GET['post_id'];
		$this->render('view',array(
			'model'=>$this->loadModel($post_id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Posten;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Posten']))
		{
			$model->attributes=$_POST['Posten'];
			$model->event_ID = $_GET['event_id'];
			$model->date = $_GET['date'];
			$model->post_volgorde = Posten::model()->getNewOrderForPosten($_GET['event_id'], $model->date);
			if($model->save())
				$this->redirect(array('/startup/startupOverview',
						      'event_id'=>$model->event_ID));
		}
		$this->layout='/layouts/column1';
		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'startupOverview' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Posten']))
		{
			$model->attributes=$_POST['Posten'];
			if($model->save())
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
	public function actionDelete()
	{
		$post_id = $_GET['post_id'];
		$event_id = $_GET['event_id'];
		try
		{
			$this->loadModel($post_id)->delete();
		}
		catch(CDbException $e)
		{
			throw new CHttpException(400,"Je kan deze post niet verwijderen.");
		}
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ?
					$_POST['returnUrl'] : array('/posten/index',
								    'event_id'=>$event_id));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$event_Id = $_GET['event_id'];
		$startDate=EventNames::model()->getStartDate($event_Id);
		$endDate=EventNames::model()->getEndDate($event_Id);

		$postenData=new Posten('searchPostDate');

		$dataModel=array(
			'postenData'=>$postenData,
			'startDate'=>$startDate,
			'endDate'=>$endDate
		);
		$this->layout='//layouts/column1';
		$this->render('index', $dataModel);
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		//$model=new Posten('search');
		//$model->unsetAttributes();  // clear any default values
		//if(isset($_GET['Posten']))
		//	$model->attributes=$_GET['Posten'];
		//
		//$this->render('admin',array(
		//	'model'=>$model,
		//));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Posten the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Posten::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Posten $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='posten-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionMoveUpDown()
    {
		$event_id = $_GET['event_id'];
		$post_id = $_GET['post_id'];
		$date = $_GET['date'];
		$post_volgorde = $_GET['volgorde'];
		$up_down = $_GET['up_down'];

		$currentModel = Posten::model()->findByPk($post_id);

		$criteria = new CDbCriteria;

		if ($up_down=='up')
		{
			$criteria->condition = 'event_ID =:event_id AND date =:date AND post_volgorde <:order';
			$criteria->params=array(':event_id' => $event_id, ':date' => $date, ':order' => $post_volgorde);
			$criteria->order= 'post_volgorde DESC';
		}
		if ($up_down=='down')
		{
			$criteria->condition = 'event_ID =:event_id AND date =:date AND post_volgorde >:order';
			$criteria->params=array(':event_id' => $event_id, ':date' => $date, ':order' => $post_volgorde);
			$criteria->order= 'post_volgorde ASC';
		}
		$criteria->limit=1;
		$previousModel = Posten::model()->findAll($criteria);

		$tempCurrentVolgorde = $currentModel->post_volgorde;
		$currentModel->post_volgorde = $previousModel[0]->post_volgorde;
		$previousModel[0]->post_volgorde = $tempCurrentVolgorde;

		$currentModel->save();
		$previousModel[0]->save();

		$startDate=EventNames::model()->getStartDate($event_id);
		$endDate=EventNames::model()->getEndDate($event_id);

		$postenData=new Posten('searchPostDate');

		$dataModel=array(
			'postenData'=>$postenData,
			'startDate'=>$startDate,
			'endDate'=>$endDate
		);
		//if(!isset($_GET['ajax'])) $this->render('grid_view', $params);
		//$this->renderPartial('index', $dataModel);
		$this->layout='//layouts/column1';
		$this->render('index', $dataModel);
   }
}
