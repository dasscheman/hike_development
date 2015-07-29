<?php
/* @var $this OpenNoodEnvelopController */
/* @var $model OpenNoodEnvelop */

$this->breadcrumbs=array(
	'Open Nood Envelops'=>array('index'),
	$model->open_nood_envelop_ID,
);

$this->menu=array(
	array('label'=>'List OpenNoodEnvelop', 'url'=>array('index')),
	array('label'=>'Create OpenNoodEnvelop', 'url'=>array('create')),
	array('label'=>'Update OpenNoodEnvelop', 'url'=>array('update', 'id'=>$model->open_nood_envelop_ID)),
	array('label'=>'Delete OpenNoodEnvelop', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->open_nood_envelop_ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OpenNoodEnvelop', 'url'=>array('admin')),
);
?>

<h1>View OpenNoodEnvelop #<?php echo $model->open_nood_envelop_ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'open_nood_envelop_ID',
		'event_ID',
		'nood_envelop_ID',
		'group_ID',
		'opened',
		'score',
		'create_time',
		'create_user_ID',
		'update_time',
		'update_user_ID',
	),
)); ?>
