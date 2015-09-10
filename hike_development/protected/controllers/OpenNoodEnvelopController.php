<?php
// Created: 2014
// Modified: 26 jan 2015

class OpenNoodEnvelopController extends Controller
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
			array(	'deny',  // deny if event_id is not set
				'actions'=>array('update', 'create'),
				'expression'=> '!isset($_GET["group_id"])',
			),
            array(	'allow', // allow admin user to perform 'viewplayers' actions
                'actions'=>array('index', 'update', 'delete'),
                'expression'=> 'OpenNoodEnvelop::model()->isActionAllowed(
                    Yii::app()->controller->id,
                    Yii::app()->controller->action->id,
                    $_GET["event_id"])',
            ),
            array(	'allow', // allow admin user to perform 'viewplayers' actions
                'actions'=>array('create'),
                'expression'=> 'OpenNoodEnvelop::model()->isActionAllowed(
                    Yii::app()->controller->id,
                    Yii::app()->controller->action->id,
                    $_GET["event_id"],
					"",
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
		$nood_envelop_id=$_GET['nood_envelop_id'];
		$event_id=$_GET['event_id'];
		$group_id=$_GET['group_id'];
		$model=new OpenNoodEnvelop;

		$noodEnvelop = NoodEnvelop::model()->find('nood_envelop_ID =:nood_envelop_Id',
						array(':nood_envelop_Id' => $nood_envelop_id));

		$model->event_ID = $event_id;
		$model->nood_envelop_ID = $nood_envelop_id;
		$model->group_ID = $group_id;
		$model->opened = 1;

		if($model->save())
			$this->redirect(array('/game/groupOverview',
						  'event_id'=>$_GET['event_id'],
						  'group_id'=>$_GET['group_id']));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		/*
		if(isset($_POST['OpenNoodEnvelop']))
		{
			$model->attributes=$_POST['OpenNoodEnvelop'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->open_nood_envelop_ID));
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

		if(isset($_POST['OpenNoodEnvelop']))
		{
			$model->attributes=$_POST['OpenNoodEnvelop'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->open_nood_envelop_ID));
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

		$dataProvider=new CActiveDataProvider(
			'OpenNoodEnvelop',
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
		$model=new OpenNoodEnvelop('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['OpenNoodEnvelop']))
			$model->attributes=$_GET['OpenNoodEnvelop'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return OpenNoodEnvelop the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=OpenNoodEnvelop::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param OpenNoodEnvelop $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='open-nood-envelop-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
