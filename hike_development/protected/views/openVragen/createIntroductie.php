<?php
// Created: 4 jan 2015
// Modified: 4 jan 2015
/* @var $this OpenVragenController */
/* @var $model OpenVragen */

$this->breadcrumbs=array(
	'Startup Spel Overzicht'=>array('/startup/startupOverview','event_id'=>$_GET['event_id']),
    'Introductie Overzicht'=>array('/Route/viewIntroductie','event_id'=>$_GET['event_id']),
);
?>

<h1>Introductie Vraag Maken</h1>

<?php echo $this->renderPartial('_formCreate', array('model'=>$model)); ?>