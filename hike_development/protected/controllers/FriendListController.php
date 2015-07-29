<?php
// Created: 2014
// Modified: 3 jan 2015

class FriendListController extends Controller
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
			array(	'allow',  // deny if group_id is not set
				'actions'=>array('create'),
				'expression'=> '?',
			),			
            array(	'allow', // allow admin user to perform 'viewplayers' actions
                'actions'=>array('connect', 'accept', 'decline','update', 'delete'),
				'users'=> array('@'),
            ),
          /*  array(	'allow', // allow admin user to perform 'viewplayers' actions
                'actions'=>array('update', 'delete'),
                'expression'=> 'FriendList::model()->isActionAllowed(
                    Yii::app()->controller->id,
                    Yii::app()->controller->action->id,
                    Yii::app()->user->id)',
            ),*/
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
		$model=new FriendList;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['FriendList']))
		{
			$model->attributes=$_POST['FriendList'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->friend_list_ID));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionConnect()
	{
		$friendsWithUser = $_GET['user_id'];
		$modelCurrentUser=new FriendList;

		$modelCurrentUser->user_ID = Yii::app()->user->id;
		$modelCurrentUser->friends_with_user_ID = $friendsWithUser;
		$modelCurrentUser->status = 1;

		$modelNewFriendUser=new FriendList;
		$modelNewFriendUser->user_ID = $friendsWithUser;
		$modelNewFriendUser->friends_with_user_ID = Yii::app()->user->id;
		$modelNewFriendUser->status = 0;
		
		$valid=$modelCurrentUser->validate();
		$valid=$modelNewFriendUser->validate() && $valid;

		if($valid)
		{
			// use false parameter to disable validation
			$modelCurrentUser->save(false);
			$modelNewFriendUser->save(false);
			$this->redirect(array('users/searchFriends'));
		}
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

		if(isset($_POST['FriendList']))
		{
			$model->attributes=$_POST['FriendList'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->friend_list_ID));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionAccept()
	{
		$requstedUserId = $_GET['user_id'];
		$dataRequester = FriendList::model()->find('user_ID =:requestUserId AND
										   friends_with_user_ID =:acceptingUserId',
									 array(':requestUserId'=>$requstedUserId,
										   ':acceptingUserId'=>Yii::app()->user->id));
		$dataAccepter = FriendList::model()->find('user_ID =:requestUserId AND
										   friends_with_user_ID =:acceptingUserId',
									 array(':requestUserId'=>Yii::app()->user->id,
										   ':acceptingUserId'=>$requstedUserId));

		$modelRequester=$this->loadModel($dataRequester->friend_list_ID);
		$modelAccepter=$this->loadModel($dataAccepter->friend_list_ID);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$modelRequester->status=2;
		$modelAccepter->status=2;

		$valid=$modelRequester->validate();
		$valid=$modelAccepter->validate() && $valid;

		if($valid)
		{
			// use false parameter to disable validation
			$modelRequester->save(false);
			$modelAccepter->save(false);
			
		}
		$this->redirect(array('game/viewUser','user_id'=>Yii::app()->user->id));
	}

	public function actionDecline()
	{
		$requstedUserId = $_GET['user_id'];
		$dataAccepter = FriendList::model()->find('user_ID =:requestUserId AND
										   friends_with_user_ID =:acceptingUserId',
									 array(':requestUserId'=>Yii::app()->user->id,
										   ':acceptingUserId'=>$requstedUserId));

		$modelAccepter=$this->loadModel($dataAccepter->friend_list_ID);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$modelAccepter->status=3;

		if($modelAccepter->save())
		{echo "save";
			$this->redirect(array('game/viewUser','user_id'=>Yii::app()->user->id));			
		}
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
		$dataProvider=new CActiveDataProvider('FriendList');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new FriendList('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['FriendList']))
			$model->attributes=$_GET['FriendList'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return FriendList the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=FriendList::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param FriendList $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='friend-list-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
