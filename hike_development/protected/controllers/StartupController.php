<?php
// Created: 2014
// Last modified: 21 feb 2015

class StartupController extends Controller
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
        array(	'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('index'),
                //'actions'=>array('dynamicDays', 'create'),
                'users'=>array('@'),
            ),	
        array(	'allow', // allow admin user to perform 'viewplayers' actions
                'actions'=>array('startupOverview'),
                'expression'=> 'DeelnemersEvent::model()->isActionAllowed(
                    Yii::app()->controller->id,
                    Yii::app()->controller->action->id,
                    $_GET["event_id"])'),
			array(	'deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex()
	{
		$user_id = Yii::app()->user->id;
		
		if($user_id==NULL)   
		{
			throw new CHttpException(403,'Je bent niet ingelogd');
		}
	
		/**
		 * Als er maar 1 hike is met status active (of introdcutie) dan gelijk
		 * naar het game overview van deze hike
		 */
		if(GeneralFunctions::checkForSingleActiveEventForUser())
		{
			/**
			 * Als de ingelogde gebruiker ingeschreven is voor 1 event en dat event is
			 * actief (gestart, introductie), dan direct door naar gameoverview.
			 */
			$event_id = GeneralFunctions::getSingleActiveEventIdForUser();
			$this->redirect(array('startup/startupOverview',
						      'event_id'=>$event_id));
		}
		
		/**
		 * Als er uberhaubt maar 1 hike is waar de ingelogde gebruiker voor ingeschreven
		 * is, dan direct door naar game overview.
		 */
		if(GeneralFunctions::checkForSingleEventForUser())
		{
			/**
			 * Als de ingelogde gebruiker ingeschreven is voor 1 event en dat event is
			 * actief (gestart), dan direct door naar gameoverview.
			 */
			$event_id = GeneralFunctions::getSingleEventIdForUser();
			$this->redirect(array('startup/startupOverview',
						      'event_id'=>$event_id));
		}
		
		if($user_id==1)   
		{					
			/**
			 * Als admin is ingelogd, dan moet alles getoont worden.
			 */
			$dataprovider = new CActiveDataProvider('DeelnemersEvent');
		}
	    else
		{
			$where = "user_ID = $user_id AND rol = 1";
		
			$dataprovider =new CActiveDataProvider('DeelnemersEvent',
			    array(
				'criteria'=>array(
				    'condition'=>$where,
				    //'order'=>'deelnemers_ID DESC',
				    ),
				'pagination'=>array(
					'pageSize'=>15,
				),
			));  
		}
		
		$this->render('index',array(
			'deelnemersEventDataProvider'=>$dataprovider,
		));
	}
	
	/**
	 * Lists all models.
	 */
	public function actionStartupOverview()
	{       
		$event_Id = $_GET['event_id'];
		$where = "event_ID = $event_Id AND (rol = 2 OR rol = 1)";
		$organisatieDataProvider=new CActiveDataProvider(
			'DeelnemersEvent',
			array(
				'criteria'=>array(
					'condition'=>$where,
					'order'=>'rol ASC',),
				'pagination'=>array(
					'pageSize'=>50,),
			)
		);

		$where = "event_ID = $event_Id";
		$groupsDataProvider=new CActiveDataProvider(
			'Groups',
		    array(
				'criteria'=>array(	
					'condition'=>$where,
					'order'=>'group_name ASC'
				 ),
				'pagination'=>array(
					'pageSize'=>10,),
			)
		);

		$this->render('startupOverview', array(
			'organisatieDataProvider'=>$organisatieDataProvider,
			'groupsDataProvider'	=>$groupsDataProvider,
		));
	}
}
