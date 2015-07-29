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

<h1>Update OpenVragenAntwoorden <?php echo $model->open_vragen_antwoorden_ID; ?></h1>

<?php  echo $this->renderPartial('_formControle', array('model'=>$model));
?>