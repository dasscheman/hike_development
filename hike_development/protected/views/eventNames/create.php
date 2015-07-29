<?php
// Created: 2014
// Modified: 22 feb 2015

/* @var $this EventNamesController */
/* @var $model EventNames */

$this->breadcrumbs=array(
	'Profiel'=>array('/game/viewUser'),
);
?>

<h1>Hike aanmaken</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>