<?php
/* @var $this EventNamesController */
/* @var $model EventNames */

$this->breadcrumbs=array(
	'Startup Spel Overzicht'=>array('/startup/startupOverview','event_id'=>$model->event_ID),
);

/*
$this->menu=array(
	array('label'=>'List EventNames', 'url'=>array('index')),
	array('label'=>'Manage EventNames', 'url'=>array('admin')),
);*/
?>

<h1>Status van Hike aanpassen</h1>
<?php echo $this->renderPartial('_changeStatus', array('model'=>$model)); ?>