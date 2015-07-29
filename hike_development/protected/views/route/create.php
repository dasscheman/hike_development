<?php
// Created: 2014
// Modified: 5 jan 2014

/* @var $this RouteController */
/* @var $model Route */

$this->breadcrumbs=array(
	'Startup Spel Overzicht'=>array('/startup/startupOverview','event_id'=>$_GET['event_id']),
	'Route Overzicht'=>array('/route/index','event_id'=>$_GET['event_id']),
);
?>

<h1>Create Route</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>