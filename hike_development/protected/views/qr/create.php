<?php
/* @var $this QrController */
/* @var $model Qr */

$this->breadcrumbs=array(
	'Startup Spel Overzicht'=>array('/startup/startupOverview','event_id'=>$_GET['event_id']),
);
/*
$this->menu=array(
	array('label'=>'List Qr', 'url'=>array('index')),
	array('label'=>'Manage Qr', 'url'=>array('admin')),
);*/
?>

<h1>Stille post maken</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>