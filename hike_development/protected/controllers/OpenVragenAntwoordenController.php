<?php
// Created: 2014
// Modified: 20 feb 2015

class OpenVragenAntwoordenController extends Controller
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
			'postOnly + delete', // we only allow deletion via PFOST request
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
            array(	'allow', // allow admin user to perform 'viewplayers' actions
                'actions'=>array('antwoordGoedOfFout'),
                'expression'=> 'OpenVragenAntwoorden::model()->isActionAllowed(
                    Yii::app()->controller->id,
                    Yii::app()->controller->action->id,
                    $_GET["event_id"],
                    $_GET["id"])',
            ),
            array(	'allow', // allow admin user to perform 'viewplayers' actions
                'actions'=>array('viewPlayers', 'update',  'create'),
                'expression'=> 'OpenVragenAntwoorden::model()->isActionAllowed(
                    Yii::app()->controller->id,
                    Yii::app()->controller->action->id,
                    $_GET["event_id"],
                    $_GET["group_id"])',
            ),
            array(	'allow', // allow admin user to perform 'viewplayers' actions
                'actions'=>array('index', 'delete', 'viewControle', 'updateOrganisatie'),
                'expression'=> 'OpenVragenAntwoorden::model()->isActionAllowed(
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
	public function actionViewControle()
	{
		$event_id = $_GET['event_id'];
		$where = "event_ID = $event_id AND
			  checked = 0 ";

		$DataProvider=new CActiveDataProvider('OpenVragenAntwoorden',
						       array('criteria'=>array('condition'=>$where,
									       'order'=>'group_ID DESC',
										),
							     'pagination'=>array('pageSize'=>10,),
							     )
						       );
		$this->render('viewControle',array(
			'dataProvider'=>$DataProvider,
		));
	}


	public function actionViewPlayers()
	{
		$event_id = $_GET['event_id'];
		$group_id = $_GET['group_id'];

		$testwhere = "event_ID = $event_id AND group_ID = $group_id";
		$openVragenAntwoordenDataProvider=new CActiveDataProvider('OpenVragenAntwoorden',
		    array(
			 'criteria'=>array(
				'condition'=>$testwhere,
				   'order'=>'create_time DESC',
			  ),
			'pagination'=>array(
			    'pageSize'=>30,
			),
		));

		$this->render('viewPlayers',array(
			'openVragenAntwoordenDataProvider'=>$openVragenAntwoordenDataProvider,
		));
	}

	public function actionAntwoordGoedOfFout()
	{

		$model=$this->loadModel($_GET["id"]);

		$model->checked = 1;
		$model->correct = $_GET['goedfout'];
		$model->save();

		$event_id = $_GET['event_id'];
		$where = "event_ID = $event_id AND
			  checked = 0 ";

		$DataProvider=new CActiveDataProvider('OpenVragenAntwoorden',
						       array('criteria'=>array('condition'=>$where,
									       'order'=>'group_ID DESC',
										),
							     'pagination'=>array('pageSize'=>10,),
							     )
						       );
		$this->render('viewControle',array(
			'dataProvider'=>$DataProvider,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new OpenVragenAntwoorden;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['OpenVragenAntwoorden']))
		{
			$model->attributes=$_POST['OpenVragenAntwoorden'];
			if($model->save())
				$this->redirect(array('/game/groupOverview',
						      'event_id'=>$_GET['event_id'],
						      'group_id'=>$_GET['group_id']));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'groupOverview' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
		if(isset($_GET['event_id']) AND
		   isset($_GET['group_id']) AND
		   isset($_GET['vraag_id']))
		{
			$data=OpenVragenAntwoorden::model()->find('event_ID =:event_id AND
							        group_ID =:group_id AND
							        open_vragen_ID=:vraag_id',
								array(':event_id'=>$_GET['event_id'],
								      ':group_id'=>$_GET['group_id'],
								      ':vraag_id'=>$_GET['vraag_id']));
		}

		if(isset($data->open_vragen_antwoorden_ID) && $data->checked)
		{
			throw new CHttpException(403,"Vraag is al gecontroleerd!!");
		}

		if(isset($data->open_vragen_antwoorden_ID))
		{
			$id = $data->open_vragen_antwoorden_ID;
			$model=$this->loadModel($id);
		} else {
			$this->render('update',array(
				'model'=>$model,
			));
		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['OpenVragenAntwoorden']))
		{
			$model->attributes=$_POST['OpenVragenAntwoorden'];
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
		 * Updates a particular model.
		 * If update is successful, the browser will be redirected to the 'groupOverview' page.
		 * @param integer $id the ID of the model to be updated
		 */
		public function actionUpdateOrganisatie()
		{
				if(isset($_GET['event_id']) AND
				   isset($_GET['group_id']) AND
				   isset($_GET['vraag_id']))
				{$data=OpenVragenAntwoorden::model()->find('event_ID =:event_id AND
											group_ID =:group_id AND
											open_vragen_ID=:vraag_id',
										array(':event_id'=>$_GET['event_id'],
											  ':group_id'=>$_GET['group_id'],
											  ':vraag_id'=>$_GET['vraag_id']));}
				if(isset($data->open_vragen_antwoorden_ID))
				{$id = $data->open_vragen_antwoorden_ID;}

				$model=$this->loadModel($id);

				// Uncomment the following line if AJAX validation is needed
				// $this->performAjaxValidation($model);

				if(isset($_POST['OpenVragenAntwoorden']))
				{
					$model->attributes=$_POST['OpenVragenAntwoorden'];
					if($model->save())
						$this->redirect(array('/game/groupOverview',
									  'event_id'=>$model->event_ID,
									  'group_id'=>$model->group_ID));
				}

				$this->render('updateOrganisatie',
							  array('model'=>$model,
									)
							  );
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
		$dataProvider=new CActiveDataProvider('OpenVragenAntwoorden',
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
		$model=new OpenVragenAntwoorden('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['OpenVragenAntwoorden']))
			$model->attributes=$_GET['OpenVragenAntwoorden'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return OpenVragenAntwoorden the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=OpenVragenAntwoorden::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param OpenVragenAntwoorden $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='open-vragen-antwoorden-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

/*	public function actionDynamicVraag()
	{
		$day_id = $_POST['day_id'];
		$event_id = $_POST['event_id'];


		$data=Posten::model()->findAll('day_ID =:day_id AND event_ID =:event_id',
			  array(':day_id'=>$day_id,
				':event_id'=>$event_id));
	   	$mainarr = array();

		foreach($data as $obj)
		{
			//De post naam moet gekoppeld worden aan de post_id:
			$mainarr["$obj->post_ID"] = Posten::model()->getPostName($obj->post_ID);
		}

		foreach($mainarr as $value=>$name)
		{
		    echo CHtml::tag('option', array('value'=>$value), CHtml::encode($name),true);
		}
		// weet niet zeker of dit wel nodig is.
		return $mainarr;

	}*/
}
