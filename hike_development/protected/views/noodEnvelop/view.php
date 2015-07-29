<?php
/* @var $this NoodEnvelopController */
/* @var $model NoodEnvelop */

$this->breadcrumbs=array(
	'Nood Envelops'=>array('index'),
	$model->nood_envelop_ID,
);

$this->menu=array(
	array('label'=>'List NoodEnvelop', 'url'=>array('index')),
	array('label'=>'Create NoodEnvelop', 'url'=>array('create')),
	array('label'=>'Update NoodEnvelop', 'url'=>array('update', 'id'=>$model->nood_envelop_ID)),
	array('label'=>'Delete NoodEnvelop', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->nood_envelop_ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage NoodEnvelop', 'url'=>array('admin')),
);
?>

<h1>View NoodEnvelop #<?php echo $model->nood_envelop_ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nood_envelop_ID',
		'nood_envelop_name',
		'event_ID',
		'day_ID',
		'route_techniek_ID',
		'nood_envelop_volgorde',
		'coordinaat',
		'opmerkingen',
		'score',
		'create_time',
		'create_user_ID',
		'update_time',
		'update_user_ID',
	),
)); ?>
