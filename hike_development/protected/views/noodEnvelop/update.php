<?php
// Created: 2014
// Modified: 11 jan 2014

/* @var $this NoodEnvelopController */
/* @var $model NoodEnvelop */

$this->breadcrumbs=array(
	'Startup Spel Overzicht'=>array('/startup/startupOverview','event_id'=>$model->event_ID),
	'Route Overzicht'=>array('/route/index','event_id'=>$model->event_ID),
);

?>

<h1>Noodenvelop <?php echo $model->nood_envelop_name; ?> bijwerken</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>