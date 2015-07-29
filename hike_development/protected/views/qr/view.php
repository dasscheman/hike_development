<?php
/* @var $this QrController */
/* @var $model Qr */

$this->breadcrumbs=array(
	'Qrs'=>array('index'),
	$model->qr_ID,
);

$this->menu=array(
	array('label'=>'List Qr', 'url'=>array('index')),
	array('label'=>'Create Qr', 'url'=>array('create')),
	array('label'=>'Update Qr', 'url'=>array('update', 'id'=>$model->qr_ID)),
	array('label'=>'Delete Qr', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->qr_ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Qr', 'url'=>array('admin')),
);
?>

<h1>View Qr #<?php echo $model->qr_ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'qr_ID',
		'qr_name',
		'qr_code',
		'event_ID',
		'qr_volgorde',
		'score',
		'create_time',
		'create_user_ID',
		'update_time',
		'update_user_ID',
	),
)); ?>
