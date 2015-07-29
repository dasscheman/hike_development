<?php
/* @var $this QrCheckController */
/* @var $model QrCheck */

$this->breadcrumbs=array(
	'Qr Checks'=>array('index'),
	$model->qr_check_ID,
);

$this->menu=array(
	array('label'=>'List QrCheck', 'url'=>array('index')),
	array('label'=>'Create QrCheck', 'url'=>array('create')),
	array('label'=>'Update QrCheck', 'url'=>array('update', 'id'=>$model->qr_check_ID)),
	array('label'=>'Delete QrCheck', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->qr_check_ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage QrCheck', 'url'=>array('admin')),
);
?>

<h1>View QrCheck #<?php echo $model->qr_check_ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'qr_check_ID',
		'qr_ID',
		'event_ID',
		'group_ID',
		'score',
		'create_time',
		'create_user_ID',
		'update_time',
		'update_user_ID',
	),
)); ?>
