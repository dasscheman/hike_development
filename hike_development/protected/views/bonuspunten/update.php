<?php
/* @var $this BonuspuntenController */
/* @var $model Bonuspunten */

$this->breadcrumbs=array(
	'Spel Overzicht'=>array('/game/gameOverview','event_id'=>$_GET['event_id']),
);

$this->menu=array(
	array('label'=>'Delete Bonuspunten',
          'url'=>'#',
          'linkOptions'=>array('submit'=>array('delete',
                                               'id'=>$model->bouspunten_ID),
                               'confirm'=>'Weet je zeker dat je deze bonuspunten wilt verwijderen?')),
);
?>

<h1>Bonuspunten Bijwerken<?php echo $model->bouspunten_ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>