<?php
/* @var $this PostPassageController */
/* @var $model PostPassage */

$this->breadcrumbs=array(
	'Spel Overzicht'=>array('/game/gameOverview','event_id'=>$_GET['event_id']),
	'Groeps Overzicht'=>array('/game/groupOverview',
                                'event_id'=>$_GET['event_id'],
                                'group_id'=>$_GET['group_id'])
);
/*
$this->menu=array(
	array('label'=>'List PostPassage', 'url'=>array('index')),
	array('label'=>'Manage PostPassage', 'url'=>array('admin')),
);*/
?>

<h1>Vertrek startpost registreren
	<sup><small>
		<?php echo CHtml::link('<i class="fa fa-question-circle fa-inverse"></i>',
		array('/site/help#VertrekStartPost'),
		array('target'=>'_blank')); ?>
	</small></sup>
</h1>

<?php echo $this->renderPartial('_formDayStart', array('model'=>$model)); ?>