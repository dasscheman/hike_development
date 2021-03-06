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
<h2>Vertrek van Post Registreren <?php echo CHtml::link(TbHtml::icon(TbHtml::ICON_QUESTION_SIGN),
					  array('/site/help#ScoreOverzicht'),
					  array('target'=>'_blank')); ?></h2>

<?php echo $this->renderPartial('_formVertrek', array('model'=>$model)); ?>