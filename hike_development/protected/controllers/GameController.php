<?php
class GameController extends Controller
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
			//'deelnemersEventContext + index, create, view, update, delete', //check rol of user for certain event
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
			array(	'deny',  // deny if group_id is not set
				'actions'=>array('groupoverview'),
				'expression'=> '!isset($_GET["group_id"])',
			),
			array('allow', // allow authenticated user to perform 'create'
				'actions'=>array('index', 'viewUser'),
				'users'=> array('@'),
			),
			array(	'allow', // allow admin user to perform 'viewplayers' actions
				'actions'=>array('gameOverview'),
				/*'expression'=> 'DeelnemersEvent::model()->isActionAllowed(
				    Yii::app()->controller->id,
				    Yii::app()->controller->action->id,
				    $_GET["event_id"])',*/
			),
			array(	'allow', // allow admin user to perform 'viewplayers' actions
				'actions'=>array('groupOverview', 'viewUser'),
				'expression'=> 'DeelnemersEvent::model()->isActionAllowed(
				    Yii::app()->controller->id,
				    Yii::app()->controller->action->id,
				    $_GET["event_id"],
				    $_GET["group_id"])',
			),
			array('deny',  // deny all users
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
			$this->redirect(array('game/gameOverview',
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
			$this->redirect(array('game/gameOverview',
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

	/**
	 * Lists all models.
	 */
	public function actionGameOverview()
	{
		$event_Id = $_GET['event_id'];
		$where = "event_ID = $event_Id";
		$dataProvider=new CActiveDataProvider('Groups',
		    array(
			'criteria'=>array(
			    'condition'=>$where,
			    //'order'=>'group_ID DESC',
			    ),
			'pagination'=>array(
			    'pageSize'=>10,
			),
		));

		$this->render('gameOverview',array(
			'dataProvider'=>$dataProvider,
		));
	}



	/**
	 * Lists all models.
	 */
	public function actionGroupOverview()
	{
		$event_Id = $_GET['event_id'];
		$group_Id = $_GET['group_id'];

		$ppwhere = "event_ID = $event_Id AND group_ID = $group_Id";
		$postPassageDataProvider=new CActiveDataProvider('PostPassage',
		array(
		    'criteria'=>array(
			'condition'=>$ppwhere,
			//'order'=>'group_ID DESC',
			),
		    'pagination'=>array(
			'pageSize'=>10,
		    ),
		));


        $ovwhere = "event_ID =$event_Id AND group_ID = $group_Id AND checked=0";
		$teControlerenOpenVragenDataProvider=new CActiveDataProvider('OpenVragenAntwoorden',
		    array(
			 'criteria'=>array(
				'condition'=>$ovwhere
			    ),
			'pagination'=>array(
			    'pageSize'=>10,
			),
		));

		$newhere = "event_ID = $event_Id AND group_ID = $group_Id";
		$openNoodEnvelopDataProvider=new CActiveDataProvider('OpenNoodEnvelop',
		    array(
			'criteria'=>array(
			    'condition'=>$newhere,
			    //'order'=>'group_ID DESC',
			    ),
			'pagination'=>array(
			    'pageSize'=>30,
			),
		));

		$this->render('groupOverview',array(
			'postPassageDataProvider'=>$postPassageDataProvider,
			'teControlerenOpenVragenDataProvider'=>$teControlerenOpenVragenDataProvider,
			'openNoodEnvelopDataProvider'=>$openNoodEnvelopDataProvider,
		));
	}


	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($event_Id, $user_Id, $rol, $group_Id)
	{
		/*$rol = DeelnemersEvent::model()->getRolOfPlayer($event_Id,
                                                        $user_Id);*/
		switch ($rol)
		{
			case "0":
			case "1":
				$this->render('view',array(
				    'postPassageDataProvider'=>PostPassage::model()->postPassageAllDataProvider($event_Id),
				));
				break;
			case "2":
				$this->render('view',array(
				    'postPassageDataProvider'=>PostPassage::model()->postPassageGroupDataProvider($event_Id, $group_Id),
				));
				break;
			case "3":
				$this->render('view',array(
				    'postPassageDataProvider'=>PostPassage::model()->postPassageAllDataProvider($event_Id),
				));
				break;
			default:
				$this->render('view',array(
				    'model'=>$this->loadModel($id),
				));
		}

	}

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionViewUser()
    {
		$user_id = Yii::app()->user->id;
		$userData=Users::model()->findByPk($user_id);

		$friendsData=new Users('searchFriends');
		$friendsData->unsetAttributes();

		$pendingFriendsData=new Users('searchPending');
		$pendingFriendsData->unsetAttributes();

		if(isset($_GET['Users'])) {
			$friendsData->attributes=$_GET['Users'];
			$pendingFriendsData->attributes=$_GET['Users'];
		}

		$hikeData=new EventNames('search');
		$hikeData->unsetAttributes();
		if(isset($_GET['EventNames'])) {
			$hikeData->attributes=$_GET['EventNames'];
		}

		$this->render('viewUser',
			array(
				'userData'=>$userData,
				'friendsData'=>$friendsData,
				'pendingFriendsData'=>$pendingFriendsData,
				'hikeData'=>$hikeData,
		));
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
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
