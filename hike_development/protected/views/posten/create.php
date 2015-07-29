<?php
/* @var $this PostenController */
/* @var $model Posten */

$this->breadcrumbs=array(
	'Startup Spel Overzicht'=>array('/startup/startupOverview','event_id'=>$_GET['event_id']),
);
?>

<h1>Create Posten</h1>

<?php echo $this->renderPartial('_formCreate', array('model'=>$model)); ?>