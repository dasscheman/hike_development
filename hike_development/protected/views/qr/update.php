<?php
/* @var $this QrController */
/* @var $model Qr */

$this->breadcrumbs=array(
	'Startup Spel Overzicht'=>array('/startup/startupOverview','event_id'=>$model->event_ID),
    'Route Overzicht'=>array('/route/view','route_id'=>$model->route_ID,'event_id'=>$model->event_ID),
);

?>

<h1>Update Qr <?php echo $model->qr_ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>