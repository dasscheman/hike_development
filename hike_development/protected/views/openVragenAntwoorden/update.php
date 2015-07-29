<?php
/* @var $this OpenVragenAntwoordenController */
/* @var $model OpenVragenAntwoorden */

$this->breadcrumbs=array(
	'Spel Overzicht'=>array('/game/gameOverview','event_id'=>$_GET['event_id']),
	'Group Overzicht'=>array('/game/groupOverview',
                                 'event_id'=>$_GET['event_id'],
                                 'group_id'=>$_GET['group_id']),
);
?>

<h2>Antwoord bijwerken  <?php echo CHtml::link(TbHtml::icon(TbHtml::ICON_QUESTION_SIGN),
					  array('/site/help#ScoreOverzicht'),
					  array('target'=>'_blank')); ?></h2>

<?php echo $this->renderPartial('_form', array('model'=>$model));?>