<?php
/* @var $this OpenVragenAntwoordenController */
/* @var $model OpenVragenAntwoorden */

$this->breadcrumbs=array(
	'Open Vragen Antwoordens'=>array('index'),
	$model->open_vragen_antwoorden_ID,
);

$this->menu=array(
	array('label'=>'List OpenVragenAntwoorden', 'url'=>array('index')),
	array('label'=>'Create OpenVragenAntwoorden', 'url'=>array('create')),
	array('label'=>'Update OpenVragenAntwoorden', 'url'=>array('update', 'id'=>$model->open_vragen_antwoorden_ID)),
	array('label'=>'Delete OpenVragenAntwoorden', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->open_vragen_antwoorden_ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OpenVragenAntwoorden', 'url'=>array('admin')),
);
?>

<h1>View OpenVragenAntwoorden #<?php echo $model->open_vragen_antwoorden_ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'open_vragen_antwoorden_ID',
		'open_vragen_ID',
		'group_ID',
		'vraag',
		'antwoord_spelers',
		'checked',
		'correct',
		'score',
		'create_time',
		'create_user_ID',
		'update_time',
		'update_user_ID',
	),
)); ?>
