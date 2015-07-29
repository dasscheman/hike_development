<?php
// Created: 2014
// Modified: 11 jan 2015

/* @var $this OpenVragenController */
/* @var $model OpenVragen */

$this->breadcrumbs=array(
	'Startup Spel Overzicht'=>array('/startup/startupOverview','event_id'=>$_GET['event_id']),
	'Route Overzicht'=>array('/route/index','event_id'=>$model->event_ID),
);

?>

<h1>Vraag Maken</h1>

<?php echo $this->renderPartial('_formCreate', array('model'=>$model)); ?>