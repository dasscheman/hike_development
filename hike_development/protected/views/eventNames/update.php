<?php
/* @var $this EventNamesController */
/* @var $model EventNames */

if (Yii::app()->controller->action->id == "updateImage"){
	$this->breadcrumbs=array(
		'Startup Spel Overzicht'=>array('/startup/startupOverview','event_id'=>$_GET['event_id']),
		'Hike Instellingen'=>array('/EventNames/update','event_id'=>$_GET['event_id']),
	);
} else{
	$this->breadcrumbs=array(
		'Startup Spel Overzicht'=>array('/startup/startupOverview','event_id'=>$_GET['event_id']),
	);

	$this->menu=array(
		array('label'=>'Hike logo veranderen', 'url'=>array('updateImage', 'event_id'=>$model->event_ID)),
		/*array('label'=>'Hike verwijderen',
			  'url'=>'#',
			  'linkOptions'=>array('submit'=>array('delete',
							   'event_id'=>$model->event_ID),
					   'confirm'=>'Weet je zeker dat je deze Hike wilt verwijderen?')),*/
	);
}
?>

<h1>Update Hike <?php echo $model->event_name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>