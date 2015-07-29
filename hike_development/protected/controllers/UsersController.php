<?php
// Created: 2014
// Modified: 22 feb 2015

class UsersController extends Controller
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
			array(	'allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('resendPasswordUser', 'create'),
				'users'=>array('?'),
			),
			array('deny', //deny all users
				'users'=>array('?'),
			),
			array(	'allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
				'users'=>array('admin'),
			),
			array('allow', // Anyone who is logged on, can searchfriends,update and view his own profile
				  'actions'=>array('searchFriends', 'update', 'view', 'ChangePassword'),
				  'users'=>array('@'),
				 ),
			array('allow', // allow admin user to perform 'viewplayers' actions
				  'actions'=>array('index', 'delete', 'updateAdmin'),
				  'expression'=> 'Users::model()->isActionAllowed(
				  	Yii::app()->controller->id,
					Yii::app()->controller->action->id,
					$_GET["event_id"])'),
			array('deny', // deny all users
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
		//$model=new Users;
		$model=new Users('create');
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			if($model->save())
				$this->redirect(array('site/index')); 
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionChangePassword()
	{
		$this->layout='//layouts/column1';
		$model=$this->loadModel(Yii::app()->user->id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			if($model->save())
				$this->redirect(array('/game/viewUser'));
		}

		$this->render('changePassword',array(
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
		$this->layout='//layouts/column1';

		$model=$this->loadModel(Yii::app()->user->id);
		$model->password_repeat = $model->password;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			if($model->save())
				$this->redirect(array('/game/viewUser'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	
	public function actionResendPasswordUser()
	{		
		$tempModel=new Users;
		if(isset($_POST['Users']))
		{
			$tempModel->attributes=$_POST['Users'];
			$newModel = Users::model()->find('username =:username AND email =:email',
											 array(':username' => $tempModel->username,
												   ':email' => $tempModel->email));
			if (isset($newModel)) {
				$newWachtwoord = GeneralFunctions::randomString(4);
				$model=$this->loadModel($newModel->user_ID);
				$model->password =$newWachtwoord;
				$model->password_repeat = $newWachtwoord;
				$emailSend = Users::model()->sendEmailWithNewPassword($model, $newWachtwoord);
				if($emailSend && $model->save())
				{
					$this->redirect(array('site/index'));
				}
			}
			echo "DAT MAG niet"; 
		}
		$this->render('updateGetNewPass',array(
			'model'=>$tempModel,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
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
			throw new CHttpException(400,"Je kan deze gebruiker niet verwijderen.");
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Users');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Users('search');
		$model->unsetAttributes(); // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionSearchFriends()
	{
		$model=new Users('search');
		$model->unsetAttributes(); // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];
		
		$this->layout='//layouts/column1';
		$this->render('searchFriends',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Users the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Users $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
