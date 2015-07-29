<?php
// Created: 2014
// Modified: 18 jan 2015

class NoodEnvelopController extends Controller
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
			array(	'deny',  // deny if event_id is not set
				'actions'=>array('create'),
				'expression'=> '!isset($_GET["route_id"])',
			),							
			array(	'deny',  // deny if event_id is not set
				'actions'=>array('delete', 'update'),
				'expression'=> '!isset($_GET["nood_envelop_id"])',
			),						
			array(	'deny',  // deny if group_id is not set
				'actions'=>array('viewPlayers'),
				'expression'=> '!isset($_GET["group_id"])',
			),	
			array(	'allow', // only when $_GET are set		
					'actions'=>array('moveUpDown'),
					'expression'=> 'NoodEnvelop::model()->isActionAllowed(
						Yii::app()->controller->id,
						Yii::app()->controller->action->id,
						$_GET["event_id"],
						$_GET["nood_envelop_id"],
						$_GET["date"],
						$_GET["volgorde"],
						$_GET["up_down"])'),
			array('allow', // allow authenticated user to perform 'index' actions
				'actions'=>array('create', 'index', 'update', 'delete', 'viewPlayers' ),
				'expression'=> 'NoodEnvelop::model()->isActionAllowed(
                    Yii::app()->controller->id,
                    Yii::app()->controller->action->id,
                    $_GET["event_id"])',
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
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionViewPlayers()
	{
		$event_id = $_GET['event_id'];   
		
		$day_id = EventNames::model()->getActiveDayOfHike($event_id);
			
		$where = "event_ID = $event_id AND day_ID = $day_id";
		$noodEnvelopDataProvider=new CActiveDataProvider('NoodEnvelop',
		    array(
			'criteria'=>array(
			    'condition'=>$where,
			    'order'=>'nood_envelop_volgorde ASC',
			    ),
			'pagination'=>array(
			    'pageSize'=>30,
			),
		));
		$this->render('viewPlayers',array(
			'noodEnvelopDataProvider'=>$noodEnvelopDataProvider,
		));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new NoodEnvelop;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['NoodEnvelop']))
		{
			$model->attributes=$_POST['NoodEnvelop'];
			$model->event_ID = $_GET['event_id'];
			$model->route_ID = $_GET['route_id'];
			$model->nood_envelop_volgorde = NoodEnvelop::model()->getNewOrderForNoodEnvelop(
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

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
		$nood_envelop_id = $_GET['nood_envelop_id'];
		$model=$this->loadModel($nood_envelop_id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['NoodEnvelop']))
		{
			$model->attributes=$_POST['NoodEnvelop'];
			if($model->save())
				$this->redirect(array(
					'/route/view',
					'event_id'=>$model->event_ID,
					'route_id'=>$model->route_ID));
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
		$nood_envelop_ID = $_GET['nood_envelop_id'];

		try
		{
			$this->loadModel($nood_envelop_ID)->delete();
		}
		catch(CDbException $e)
		{		
			throw new CHttpException(400,"Je kan deze hint niet verwijderen.");
		}
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ?
					$_POST['returnUrl'] : array('/route/view',
								    'event_id'=>$_GET['event_id'],
								    'route_id'=>$_GET['route_id']));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{ 
		$hintsData=new NoodEnvelop();
	
		$this->layout='//layouts/column1';

		$this->render('index',array(
			'hintsData'=>$hintsData,
		));

	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new NoodEnvelop('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['NoodEnvelop']))
			$model->attributes=$_GET['NoodEnvelop'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return NoodEnvelop the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=NoodEnvelop::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param NoodEnvelop $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='nood-envelop-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionMoveUpDown()
    {	
		$event_id = $_GET['event_id'];
		$nood_envelop_id = $_GET['nood_envelop_id'];
		$nood_envelop_volgorde = $_GET['volgorde'];
		$up_down = $_GET['up_down'];
		$route_id = NoodEnvelop::model()->getRouteIdOfEnvelop($_GET['nood_envelop_id']);
	
		$currentModel = NoodEnvelop::model()->findByPk($nood_envelop_id);
	
		$criteria = new CDbCriteria;
	
		if ($up_down=='up')
		{
			$criteria->condition = 'event_ID =:event_id AND route_ID=:route_id AND nood_envelop_volgorde <:order';
			$criteria->params=array(':event_id' => $event_id, ':route_id' => $route_id , ':order' => $nood_envelop_volgorde);
			$criteria->order= 'nood_envelop_volgorde DESC';
		}
		if ($up_down=='down')
		{
			$criteria->condition = 'event_ID =:event_id AND route_ID=:route_id AND nood_envelop_volgorde >:order';
			$criteria->params=array(':event_id' => $event_id, ':route_id' => $route_id , ':order' => $nood_envelop_volgorde);			
			$criteria->order= 'nood_envelop_volgorde ASC';
		}
			$criteria->limit=1;
		$previousModel = NoodEnvelop::model()->findAll($criteria);
	
		$tempCurrentVolgorde = $currentModel->nood_envelop_volgorde;
		$currentModel->nood_envelop_volgorde = $previousModel[0]->nood_envelop_volgorde;
		$previousModel[0]->nood_envelop_volgorde = $tempCurrentVolgorde;
	
		$currentModel->save();
		$previousModel[0]->save();
		
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
