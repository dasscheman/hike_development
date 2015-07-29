<?php
/* @var $this BonuspuntenController */
/* @var $model Bonuspunten */

$this->breadcrumbs=array(
	'Bonuspuntens'=>array('index'),
	$model->bouspunten_ID,
);

$this->menu=array(
	array('label'=>'List Bonuspunten', 'url'=>array('index')),
	array('label'=>'Create Bonuspunten', 'url'=>array('create')),
	array('label'=>'Update Bonuspunten', 'url'=>array('update', 'id'=>$model->bouspunten_ID)),
	array('label'=>'Delete Bonuspunten', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->bouspunten_ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Bonuspunten', 'url'=>array('admin')),
);
?>

<h1>View Bonuspunten #<?php echo $model->bouspunten_ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'bouspunten_ID',
		'event_ID',
		'day_ID',
		'post_ID',
		'group_ID',
		'omschrijving',
		'score',
		'create_time',
		'create_user_ID',
		'update_time',
		'update_user_ID',
	),
)); ?>
