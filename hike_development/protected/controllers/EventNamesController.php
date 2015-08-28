<?php
// Created: 2014
// Modified: 22 feb 2015

class EventNamesController extends Controller
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
                'users'=>array('?'),),
            array(	'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create'),
                //'actions'=>array('dynamicDays', 'create'),
                'users'=>array('@'),
            ),
         /*   array(	'allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('admin'),
                'users'=>array('admin'),
            ),*/
            array('allow', // allow admin user to perform 'viewplayers' actions
                'actions'=>array('index', 'view', 'update', 'delete', 'viewPlayers', 'changeStatus', 'changeDay'),
                'expression'=> 'EventNames::model()->isActionAllowed(
                    Yii::app()->controller->id,
                    Yii::app()->controller->action->id,
                    $_GET["event_id"])',
            ),
            array(	'deny',  // deny all users
                'users'=>array('*'),),
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
        $this->layout='//layouts/column1';
        $model = new EventNames;
        // De gebruiker die de hike aanmaakt moet ook gelijk aangemaakt worden als organisatie
        $modelDeelnemersEvent = new DeelnemersEvent;
        // Het route onderdeel introductie moet ook direct aangemaakt worden.
        // Dit kan later uitgebreid worden met een keuze of de introductie gemaakt moet worden.
        $modelRoute = new Route;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['EventNames']))
        {
            $model->attributes=$_POST['EventNames'];
            $model->event_ID = EventNames::model()->determineNewHikeId();
            $model->status = 1;

            $modelDeelnemersEvent->event_ID = $model->event_ID;
            $modelDeelnemersEvent->user_ID = Yii::app()->user->id;
            $modelDeelnemersEvent->rol = 1;
            $modelDeelnemersEvent->group_ID = NULL;

            $modelRoute->day_date = 1;
            $modelRoute->route_name = "Introductie";
            $modelRoute->event_ID = $model->event_ID;
            $modelRoute->route_volgorde = 1;

            // validate BOTH $model, $modelDeelnemersEvent and $modelRoute.
            $valid=$model->validate();
            $valid=$modelDeelnemersEvent->validate() && $valid;
            $valid=$modelRoute->validate() && $valid;

            if($valid)
            {
                // use false parameter to disable validation
                $model->save(false);
                $modelDeelnemersEvent->save(false);
                $modelRoute->save(false);
                $this->redirect(array('startup/startupOverview','event_id'=>$model->event_ID));
            }
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
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['EventNames']))
        {
            $model->attributes=$_POST['EventNames'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->event_ID));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionChangeStatus($event_id)
    {
        $this->layout='//layouts/column1';
        $model=$this->loadModel($event_id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['EventNames']))
        {
            $model->attributes=$_POST['EventNames'];
			if($model->attributes['status'] == EventNames::STATUS_introductie) {
				$model->active_day = "0000-00-00";
			}
            if($model->save()){
				if ($model->status == EventNames::STATUS_gestart){
					$this->redirect(array('eventNames/changeDay','event_id'=>$model->event_ID));
				} else {
					$this->redirect(array('startup/startupOverview','event_id'=>$model->event_ID));
				}
            }
        }

        $this->render('changeStatus',array(
            'model'=>$model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionChangeDay($event_id)
    {
        $this->layout='//layouts/column1';
        $model=$this->loadModel($event_id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if(isset($_POST['EventNames']))
        {
            $model->attributes=$_POST['EventNames'];
            if($model->save())
                $this->redirect(array('startup/startupOverview','event_id'=>$model->event_ID));
        }

        $this->render('changeDay',array(
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
        try
        {
            $this->loadModel($id)->delete();
        }
        catch(CDbException $e)
        {
            throw new CHttpException(400,"Je kan deze hike niet deleten.");
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
        $dataProvider=new CActiveDataProvider('EventNames');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new EventNames('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['EventNames']))
            $model->attributes=$_GET['EventNames'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return EventNames the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=EventNames::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param EventNames $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='event-names-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /*
     * Deze actie wordt gebruikt voor de form velden. Op basis van een hike
     * en status wordt bepaald welke dagen actief kunnen zijn.
     */
/*    public function actionDynamicDays()
    {
        if($_POST['status']==1)
        {
            //$data = HikeDagen::model()->getDayNamesAvailable($_POST['event_id']);
            $data = HikeDagen::model()->findAll('event_ID =:event_Id and day_ID=:day_id',
                                array(':event_Id' =>$_POST['event_id'],
                                  ':day_id'=>8));
            $mainarr = array();

            foreach($data as $obj)
            {
                //De dag naam moet gekoppeld worden aan de day_id:
                $mainarr["$obj->day_ID"] = DayNames::model()->getDayName($obj->day_ID);
            }

            foreach($mainarr as $value=>$name)
            {
                echo CHtml::tag('option', array('value'=>$value), CHtml::encode($name),true);
            }
        }

        if($_POST['status']==2)
        {
            //$data = HikeDagen::model()->getDayNamesAvailable($_POST['event_id']);
            $data = HikeDagen::model()->findAll('event_ID =:event_Id and day_ID<>:day_id',
                                array(':event_Id' =>$_POST['event_id'],
                                  ':day_id'=>8));
            $mainarr = array();

            foreach($data as $obj)
            {
                //De dag naam moet gekoppeld worden aan de day_id:
                $mainarr["$obj->day_ID"] = DayNames::model()->getDayName($obj->day_ID);
            }

            foreach($mainarr as $value=>$name)
            {
                echo CHtml::tag('option', array('value'=>$value), CHtml::encode($name),true);
            }
                                /*
            $data = CHtml::listData($data,'day_ID','day_ID');

            foreach($data as $value=>$name)
            {
                echo CHtml::tag('option', array('value'=>$value), CHtml::encode($name),true);
            }*/
       /* }
    }*/
}
