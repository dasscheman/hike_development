<?php
// Created: 2014
// Modified: 10 jan 2014

class RouteController extends Controller
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
			array(
				'deny', // deny all users
				'users'=>array('?'),
			),		
			array(
				'allow', // allow authenticated user to perform 'create'
				'actions'=>array('view'),
				'users'=>array('@'),),	
			array(	'allow', // only when $_GET are set		
					'actions'=>array('moveUpDown'),
					'expression'=> 'Route::model()->isActionAllowed(
						Yii::app()->controller->id,
						Yii::app()->controller->action->id,
						$_GET["event_id"],
						"",
						$_GET["date"],
						$_GET["volgorde"],
						$_GET["up_down"])'),
			array(	'allow', // allow admin user to perform 'viewplayers' actions
					'actions'=>array('index', 'update', 'delete', 'create', 'viewIntroductie'),
					'expression'=> 'Route::model()->isActionAllowed(
						Yii::app()->controller->id,
						Yii::app()->controller->action->id,
						$_GET["event_id"], 
						"")'),
			array(
				'deny', //deny all users
				'users'=>array('*'),),
		);
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView()
	{
		$route_id = $_GET['route_id'];
		$event_id = $_GET['event_id'];

		$where = "event_ID = $event_id AND route_ID =$route_id";

		$vragenDataProvider=new CActiveDataProvider('OpenVragen',
			array(			
			'criteria'=>array(
				'condition'=>$where,
				'order'=>'vraag_volgorde ASC',
			 ),
			'pagination'=>array(
				'pageSize'=>50,
			),
		));

		$envelopDataProvider=new CActiveDataProvider('NoodEnvelop',
			array(			
			'criteria'=>array(
				'condition'=>$where,
				'order'=>'nood_envelop_volgorde ASC',
			 ),
			'pagination'=>array(
				'pageSize'=>50,
			),
		));

		$qrDataProvider=new CActiveDataProvider('Qr', array(
			'criteria'=>array(
				'condition'=>$where,
				'order'=>'qr_volgorde ASC',
			 ),
			'pagination'=>array(
				'pageSize'=>15,
			),
		)); 
		$this->render('view',array(
			'model'=>$this->loadModel($route_id),
			'vragenDataProvider'=>$vragenDataProvider,
			'envelopDataProvider'=>$envelopDataProvider,
			'qrDataProvider'=>$qrDataProvider,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'startupOverview' page.
	 */
	public function actionCreate()
	{
		$model=new Route;
		$qrModel=new Qr;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Route']))
		{
			$model->attributes = $_POST['Route'];
			$model->day_date = $_GET['date'];
			$model->event_ID = $_GET['event_id'];
			$model->route_volgorde = Route::model()->getNewOrderForDateRoute($_GET['event_id'], $_GET['date']);

			// Wanneer er een route onderdeel aangemaakt wordt, dan moet er gecheckt woren of er voor die dag al een 
			// begin aangemaakt is.  Als dat niet het geval is dan moet die nog aangemaakt worden.
			if (!Posten::model()->startPostExist($_GET['event_id'], $_GET['date'])) {

				$modelStartPost = new Posten;
				$modelStartPost->event_ID = $_GET['event_id'];
				$modelStartPost->post_name = 'Dag Start';
				$modelStartPost->date = $_GET['date'];
				$modelStartPost->post_volgorde = 1;
				$modelStartPost->score = 0;
			}
			
			// validate BOTH $model, $modelStartPost.
			$valid=$model->validate();
			if (isset($modelStartPost)) {
				$valid=$modelStartPost->validate() && $valid;
			}

			if($valid)
			{
				$model->save(false);
				if (isset($modelStartPost))
				{
					$modelStartPost->save(false);
				}
				// QR record can only be set after the routemodel save.
				// Because route_ID is not available before save.
				// Furthermore it is not a problem when route record is saved and
				// an error occured on qr save. Therefore this easy and fast solution is choosen.
				if (!Qr::model()->qrExistForRouteId($_GET['event_id'], $model->route_ID)) {
					$qrModel->qr_name = $model->route_name;
					$qrModel->qr_code = Qr::model()->getUniqueQrCode();
					$qrModel->event_ID = $_GET['event_id'];
					$qrModel->route_ID = $model->route_ID;
					$qrModel->qr_volgorde = Qr::model()->getNewOrderForQr($_GET['event_id'], $model->route_ID);
					$qrModel->score = 5;
					// use false parameter to disable validation
					$qrModel->save(false);
				}
				$this->redirect(array('/route/index',
							  'event_id'=>$model->event_ID));
			}
		}
		$this->layout='//layouts/column1';
		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'startupOverview' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel($_GET['route_id']);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Route']))
		{
			$model->attributes=$_POST['Route'];		
			// Wanneer er een route onderdeel aangepast wordt (datum), dan moet er gecheckt woren of er voor 
			// die dag al een begin post aangemaakt is.  Als dat niet het geval is dan moet die nog aangemaakt worden.
//Volgens mij toch niet nodig, zou mee moeten gaan met de Mysql cascade!!
			
			/*if (!Posten::model()->startPostExist($_GET['event_id'], $_GET['date'])) {
				$modelStartPost = new Posten;
				$modelStartPost->post_name = 'Dag Start';
				$modelStartPost->date = $_GET['event_id'];
				$modelStartPost->post_volgorde = 1;
				$modelStartPost->score = 0;
			}
			
			// validate BOTH $model, $modelStartPost and $qrModel.
			$valid=$model->validate();
			if (isset($modelStartPost)) {
				$valid=$modelStartPost->validate() && $valid;
			}*/
			//if($valid)*/
			if($model->save())			
			{
				$this->redirect(array('/route/index',
							  'event_id'=>$model->event_ID));
			}
		}
		$this->layout='//layouts/column1';
		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	* Deletes a particular model.
	* If deletion is successful, the browser will be redirected to the 'startupOverview' page.
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
			throw new CHttpException(400,"Je kan dit routeonderdeel niet verwijderen. Verwijder eerst alle onderdelen van deze route (vragen, stille posten)");
		}
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ?
			$_POST['returnUrl'] : array('/startup/startupOverview',
							'event_id'=>$_GET['event_id']));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$event_Id = $_GET['event_id'];
		$startDate=EventNames::model()->getStartDate($event_Id);
		$endDate=EventNames::model()->getEndDate($event_Id);
		$routeData=new Route('searchRoute');

		$dataModel=array(
			'routeData'=>$routeData,
			'startDate'=>$startDate,
			'endDate'=>$endDate
		);
		$this->layout='//layouts/column1';
		$this->render('index', $dataModel);		
	}


	/**
	 * Lists all models.
	 */
	public function actionViewIntroductie()
	{
		$event_Id = $_GET['event_id'];
		$introductieId = Route::model()->getIntroductieRouteId($event_Id);

		if (! isset($introductieId))
			$introductieId = 0;

		$where = "event_ID = $event_Id AND route_ID = $introductieId";
		$openVragenDataProvider=new CActiveDataProvider('OpenVragen',
			array(
			 'criteria'=>array(
				'condition'=>$where,
				'order'=>'vraag_volgorde ASC',
			  ),
			'pagination'=>array(
				'pageSize'=>30,
			),
		));

		$qrDataProvider=new CActiveDataProvider('Qr',
			array(
			 'criteria'=>array(
				'condition'=>$where,
				'order'=>'qr_volgorde ASC',
			  ),
			'pagination'=>array(
				'pageSize'=>30,
			),
		));

		$dataModel=array(
			'vragenData'=>$openVragenDataProvider,
			'qrData'=>$qrDataProvider
		);

		$this->render('viewIntroductie', $dataModel);		
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Route('search');
		$model->unsetAttributes(); //clear any default values
		if (isset($_GET['Route'])) {
			$model->attributes=$_GET['Route'];}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Route the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Route::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Route $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='route-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/*
	 * Deze actie wordt gebruikt voor de grid velden.  
	 */
	public function actionMoveUpDown()
	{	
		$event_id = $_GET['event_id'];
		$route_id = $_GET['route_id'];
		$date = $_GET['date'];
		$route_volgorde = $_GET['volgorde'];
		$up_down = $_GET['up_down'];

		Route::model()->setActiveTab($_GET['date']);

		$currentModel = Route::model()->findByPk($route_id);

		$criteria = new CDbCriteria;

		if ($up_down=='up')
		{
			$criteria->condition = 'event_ID =:event_id AND day_date =:date AND route_volgorde <:order';
			$criteria->params=array(':event_id' => $event_id, ':date' => $date, ':order' => $route_volgorde);
			$criteria->order= 'route_volgorde DESC';
		}
		if ($up_down=='down')
		{
			$criteria->condition = 'event_ID =:event_id AND day_date =:date AND route_volgorde >:order';
			$criteria->params=array(':event_id' => $event_id, ':date' => $date, ':order' => $route_volgorde);
			$criteria->order= 'route_volgorde ASC';
		}
		$criteria->limit=1;
		$previousModel = Route::model()->findAll($criteria);

		$tempCurrentVolgorde = $currentModel->route_volgorde;
		$currentModel->route_volgorde = $previousModel[0]->route_volgorde;
		$previousModel[0]->route_volgorde = $tempCurrentVolgorde;

		$currentModel->save();
		$previousModel[0]->save();

		$startDate=EventNames::model()->getStartDate($event_id);
		$endDate=EventNames::model()->getEndDate($event_id);

		$routeData=new Route('searchRoute');

		$dataModel=array(
			'routeData'=>$routeData,
			'startDate'=>$startDate,
			'endDate'=>$endDate
		);
		//if(!isset($_GET['ajax'])) $this->render('grid_view', $params);
		//$this->renderPartial('index', $dataModel);
		$this->layout='//layouts/column1';
		$this->render('index', $dataModel);	

	}
}
