<?php
// Created: 2014
// Modified: 10 jan 2014

/* @var $this RouteController */
/* @var $model Route */

$this->breadcrumbs=array(
	'Startup Spel Overzicht'=>array('/startup/startupOverview','event_id'=>$model->event_ID),
	'Route Overzicht'=>array('/route/index','event_id'=>$model->event_ID),
    'Route Onderdeel'=>array('/route/view','event_id'=>$model->event_ID),
);

?>

<h1>wijzig <?php echo $model->route_name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>