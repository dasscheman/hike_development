<?php
/* @var $this GroupsController */
/* @var $model Groups */

$this->breadcrumbs=array(
	'Startup Spel Overzicht'=>array('/startup/startupOverview','event_id'=>$model->event_ID),
);
/*
$this->menu=array(
	array('label'=>'Groepen Overzicht', 'url'=>array('/groups/index', 'event_id'=>$_GET['event_id'])),
	array('label'=>'Manage Groups', 'url'=>array('admin')),
);*/
?>

<h1>Groep aanmaken</h1>

<?php echo $this->renderPartial('_formCreate', array('model'=>$model)); ?>