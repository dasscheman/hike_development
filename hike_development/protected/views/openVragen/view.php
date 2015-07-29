<?php
/* @var $this OpenVragenController */
/* @var $model OpenVragen */

$this->breadcrumbs=array(
	'Startup Spel Overzicht'=>array('/startup/startupOverview','event_id'=>$model->event_ID),
);

$this->menu=array(
	array('label'=>'List OpenVragen', 'url'=>array('index')),
	array('label'=>'Create OpenVragen', 'url'=>array('create')),
	array('label'=>'Update OpenVragen', 'url'=>array('update', 'id'=>$model->open_vragen_ID)),
	array('label'=>'Delete OpenVragen', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->open_vragen_ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OpenVragen', 'url'=>array('admin')),
);
?>

<h1>View OpenVragen #<?php echo $model->open_vragen_ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'open_vragen_ID',
		'open_vragen_name',
        array(
            'name'=>'event_ID',
            'value'=>CHtml::encode(EventNames::model()->getEventName($model->event_ID))
        ),
		'vraag',
		'goede_antwoord',
		/*'create_time',
		'create_user_ID',
		'update_time',
		'update_user_ID',*/
	),
)); ?>
