<?php
// Created: 2014
// Modified: 12 jan 2015

/* @var $this DeelnemersEventController */
/* @var $model DeelnemersEvent */

$this->breadcrumbs=array(
	'Startup Spel Overzicht'=>array('/startup/startupOverview','event_id'=>$_GET['event_id']),
);

?>

<h1>Speler toevoegen en rol vaststellen voor de Hike:<?php echo EventNames::model()->getEventName($_GET['event_id']); ?>
 </h1>

<?php echo $this->renderPartial('_formCreate', array('model'=>$model)); ?>