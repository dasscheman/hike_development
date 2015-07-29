<?php
/* @var $this BonuspuntenController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Spel Overzicht'=>array('/game/gameOverview','event_id'=>$_GET['event_id']),
	'Groeps Overzicht'=>array('/game/groupOverview',
                                'event_id'=>$_GET['event_id'],
                                'group_id'=>$_GET['group_id']),
);
/*
$this->menu=array(
	array('label'=>'Create Bonuspunten', 'url'=>array('create')),
	array('label'=>'Manage Bonuspunten', 'url'=>array('admin')),
);*/
?>

<h1>Bonuspunten<sup><small>
							<?php echo CHtml::link('<i class="fa fa-question-circle fa-inverse"></i>',
							array('/site/help#Bonuspunten'),
							array('target'=>'_blank')); ?>
				 </small></sup></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$bonuspuntenDataProvider,
	'itemView'=>'_viewPlayers',
)); ?>
