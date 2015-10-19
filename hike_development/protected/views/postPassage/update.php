<?php
/* @var $this PostPassageController */
/* @var $model PostPassage */

$this->breadcrumbs=array(
	'Spel Overzicht'=>array('/game/gameOverview','event_id'=>$_GET['event_id']),
	'Groeps Overzicht'=>array('/game/groupOverview',
                                'event_id'=>$model->event_ID,
                                'group_id'=>$model->group_ID),
);

?>
<h2>Binnenkomst/Vertrek Post wijzigen <?php echo CHtml::link(TbHtml::icon(TbHtml::ICON_QUESTION_SIGN),
					  array('/site/help#ScoreOverzicht'),
					  array('target'=>'_blank')); ?></h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>