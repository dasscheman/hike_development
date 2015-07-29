<?php
/* @var $this PostPassageController */
/* @var $model PostPassage */

$this->breadcrumbs=array(
	'Post Passages'=>array('index'),
	$model->posten_passage_ID,
);

$this->menu=array(
	array('label'=>'List PostPassage', 'url'=>array('index')),
	array('label'=>'Create PostPassage', 'url'=>array('create')),
	array('label'=>'Update PostPassage', 'url'=>array('update', 'id'=>$model->posten_passage_ID)),
	array('label'=>'Delete PostPassage', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->posten_passage_ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PostPassage', 'url'=>array('admin')),
);
?>

<h1>View PostPassage #<?php echo $model->posten_passage_ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'posten_passage_ID',
		'post_ID',
		'event_ID',
		'day_ID',
		'group_ID',
		'gepasseerd',
		'binnenkomst',
		'vertrek',
		'score',
		/*'create_time',
		'create_user_ID',
		'update_time',
		'update_user_ID',*/
	),
)); ?>
