<?php
// Created: 2014
// Modified: 25 jan 2015

class ChartController extends Controller
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
			array(	'allow', // allow admin user to perform 'viewplayers' actions
				'actions'=>array('index', 'viewChart'),
				'users'=>array('@'),
			),
			array(	'deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex()
	{
	    $user_id = Yii::app()->user->id;

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
			$this->redirect(array('viewChart',
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
			$this->redirect(array('viewChart',
					      'event_id'=>$event_id));
		}	
		/**
		 * Als admin is ingelogd, dan moet alles getoont worden.
		 */
		if($user_id <> 1)
		    $where = "user_ID = $user_id";
		else
		    $where = "";
		    
		$deelnemersEventDataProvider =new CActiveDataProvider('DeelnemersEvent',
		    array(
			'criteria'=>array(
			    'condition'=>$where,
			    //'order'=>'deelnemers_ID DESC',
			    ),
			'pagination'=>array(
				'pageSize'=>15,
			),
		));  

		/**
		 * Laat alle events zien waar een gebruiker voor ingeschreven is.
		 */
		$this->render('index',
			array('deelnemersEventDataProvider'=>$deelnemersEventDataProvider,
			));
	}

	public function actionViewChart()
	{	    
		$event_id = $_GET['event_id'];
		$criteria = new CDbCriteria;
		$criteria->condition="event_ID = $event_id";
        $data = Groups::model()->findAll($criteria);
		$count = 0;
		foreach($data as $obj)
		{
			/*$testarr[$count]['name'] = DeelnemersEvent::model()->getAllPlayersOfGroup($event_id,
												  $obj->group_ID);*/
			
			$grapharr[$count]['name'] = Groups::model()->getGroupName($obj->group_ID);
			$grapharr[$count]['data'] = GraphFunctions::getGraphTotaalScorePerGroup($event_id,
											     $obj->group_ID);
			$count++;
		}
		if(!isset($grapharr))
		{
			$this->render('index');
		}
		else
		{
            $this->layout='//layouts/column1';
			$this->render('viewChart',
                array('testarr'=>$grapharr,
            ));
		}
	}
}