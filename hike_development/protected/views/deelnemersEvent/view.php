<?php
/* @var $this DeelnemersEventController */
/* @var $model DeelnemersEvent */

$this->breadcrumbs=array(
	'Startup Spel Overzicht'=>array('/startup/startupOverview','event_id'=>$model->event_ID),
);

$this->menu=array(
	array('label'=>'List DeelnemersEvent', 'url'=>array('index')),
	array('label'=>'Create DeelnemersEvent', 'url'=>array('create')),
	array('label'=>'Update DeelnemersEvent', 'url'=>array('update', 'id'=>$model->deelnemers_ID)),
	array('label'=>'Delete DeelnemersEvent', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->deelnemers_ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DeelnemersEvent', 'url'=>array('admin')),
);
?>

<h1>View DeelnemersEvent #<?php echo $model->deelnemers_ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'deelnemers_ID',
        array(
            'name'=>'event_ID',
            'value'=>CHtml::encode(EventNames::model()->getEventName($model->event_ID))
        ),
        array(
            'name'=>'user_ID',
            'value'=>CHtml::encode(Users::model()->getUserName($model->user_ID))
        ),
        array(
            'name'=>'rol',
            'value'=>CHtml::encode($model->getRolText($model->rol))
        ),
        array(
            'name'=>'group_ID',
            'value'=>CHtml::encode(Groups::model()->getGroupName($model->group_ID))
        ),
		/*'create_time',
		'create_user_ID',
		'update_time',
		'update_user_ID',*/
	),
)); ?>
