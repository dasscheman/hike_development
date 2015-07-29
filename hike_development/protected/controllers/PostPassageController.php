<?php
// Created: 2014
// Modified: 20 feb 2015

class PostPassageController extends Controller
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('dynamicpostscore', 'dynamicpostid'),
				'users'=>array('@'),
			),	
			array(	'deny',  // deny if group is not set
				'actions'=>array('create'),
				'expression'=> '!isset($_GET["group_id"])',
			),		
            array(	'allow', // allow admin user to perform 'viewplayers' actions
                'actions'=>array('index', 'update', 'delete', 'create', 'updateVertrek'),
                'expression'=> 'PostPassage::model()->isActionAllowed(
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'groupOverview' page.
	 */
	public function actionCreate()
	{
		$model=new PostPassage;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	    
		if(isset($_POST['PostPassage']))
		{
			$model->attributes=$_POST['PostPassage'];
			
			if($model->save())
				$this->redirect(array('/game/groupOverview',
						      'event_id'=>$model->event_ID,
						      'group_id'=>$model->group_ID));
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
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PostPassage']))
		{
			$model->attributes=$_POST['PostPassage'];
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
	public function actionUpdateVertrek($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PostPassage']))
		{
			$model->attributes=$_POST['PostPassage'];
			if($model->save())
				$this->redirect(array('/game/groupOverview',
						      'event_id'=>$model->event_ID,
						      'group_id'=>$model->group_ID));
		}

		$this->render('updateVertrek',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'groupOverview' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/game/groupOverview',
												 'event_id'=>$model->event_ID,
												 'group_id'=>$model->group_ID));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('PostPassage');
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
		$model=new PostPassage('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PostPassage']))
			$model->attributes=$_GET['PostPassage'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return PostPassage the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=PostPassage::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param PostPassage $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='post-passage-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
  
  	/**	
	 * Deze actie wordt gebruikt voor de form velden.
	 * Returns score depending on post_ID and event_id
	 * Deze moet anders, want er wordt sowieso altijd maar 1 waarde gereturnd, dus list is niet nodig. 
	 */
	public function actionDynamicPostScore()
	{
	    $data=Posten::model()->findAll('post_ID =:post_id, event_ID =:event_id',
			  array(':post_id'=>$_POST['post_ID'],
				':event_id'=>$_GET['event_id']));
	   
	    $data=CHtml::listData($data,'score','score');
	   
	    foreach($data as $value=>$name)
	    {
				echo CHtml::tag('option', array('value'=>$value), CHtml::encode($name),true);
	    }
	}
	
	/**
	 * Deze actie wordt gebruikt voor de form velden. 
	 * Returns list with available posten depending on day and event.
	 */
	public function actionDynamicPostId()
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
	}

}
