<?php
/* @var $this EventNamesController */
/* @var $model EventNames */


$this->breadcrumbs=array(
	'Startup Spel Overzicht'=>array('/startup/startupOverview','event_id'=>$model->event_ID),
);
?>

<h1>Hike-dag aanpassen</h1>

<?php echo $this->renderPartial('_changeDay', array('model'=>$model)); ?>