<?php
/* @var $this DeelnemersEventController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Startup Spel Overzicht'=>array('/startup/startupOverview','event_id'=>$model->event_ID),
);

$this->menu=array(
	array('label'=>'Create DeelnemersEvent', 'url'=>array('create')),
	array('label'=>'Manage DeelnemersEvent', 'url'=>array('admin')),
);
?>

<h1>Deelnemers Events</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
