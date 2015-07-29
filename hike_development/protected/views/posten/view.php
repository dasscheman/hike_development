<?php
// Created: 2014
// Modified: 18 jan 2015

/* @var $this PostenController */
/* @var $model Posten */

$this->breadcrumbs=array(
	'Startup Spel Overzicht'=>array('/startup/startupOverview','event_id'=>$model->event_ID),
    'Posten Overzicht'=>array('/posten/index','event_id'=>$model->event_ID),
);

$this->menu=array(
	array('label'=>'Delete Posten', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->post_ID),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>Post details <?php echo $model->post_name; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'post_ID',
		'post_name',
		'date',
		'score',
		/*'create_time',
		'create_user_ID',
		'update_time',
		'update_user_ID',*/
	),
)); ?>
