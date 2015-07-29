<?php
/* @var $this OpenNoodEnvelopController */
/* @var $model OpenNoodEnvelop */

$this->breadcrumbs=array(
	'Open Nood Envelops'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List OpenNoodEnvelop', 'url'=>array('index')),
	array('label'=>'Create OpenNoodEnvelop', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#open-nood-envelop-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Open Nood Envelops</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'open-nood-envelop-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'open_nood_envelop_ID',
		'event_ID',
		'nood_envelop_ID',
		'group_ID',
		'opened',
		'score',
		/*
		'create_time',
		'create_user_ID',
		'update_time',
		'update_user_ID',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
