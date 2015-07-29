<?php
/* @var $this OpenVragenAntwoordenController */
/* @var $model OpenVragenAntwoorden */

$this->breadcrumbs=array(
	'Spel Overzicht'=>array('/game/gameOverview','event_id'=>$_GET['event_id']),
	'Group Overzicht'=>array('/game/groupOverview',
                                 'event_id'=>$_GET['event_id'],
                                 'group_id'=>$_GET['group_id']),
);
/*
$this->menu=array(
	array('label'=>'List OpenVragenAntwoorden', 'url'=>array('index')),
	array('label'=>'Manage OpenVragenAntwoorden', 'url'=>array('admin')),
);*/
?>


<h1>Vraag beantwoorden<?php echo CHtml::link(TbHtml::icon(TbHtml::ICON_QUESTION_SIGN),
					  array('/site/help#VraagBeantwoorden'),
					  array('target'=>'_blank')); ?></h1>

<h2>Voor vraag <?php echo OpenVragen::model()->getOpenVragenName($_GET['vraag_id']);?> </h2>

<?php echo $this->renderPartial('_formCreate', array('model'=>$model)); ?>