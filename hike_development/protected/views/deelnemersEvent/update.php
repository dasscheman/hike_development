<?php
/* @var $this DeelnemersEventController */
/* @var $model DeelnemersEvent */

$this->breadcrumbs=array(
	'Startup Spel Overzicht'=>array('/startup/startupOverview','event_id'=>$model->event_ID),
);

$this->menu=array(
        array('label'=>'Deelnemer Toevoegen', 'url'=>array('/deelnemersEvent/create', 'event_id'=>$model->event_ID)),
	array('label'=>'Verwijder deze deelnemer',
              'url'=>'#',
              'linkOptions'=>array('submit'=>array('delete',
                                                   'id'=>$model->deelnemers_ID,
                                                   'event_id'=>$model->event_ID),
                                   'confirm'=>'Weet je zeker dat je deze gebruiker wilt verwijderen uit deze hike?')),
	
);
?>

<h1>Bijwerken van de rol van <?php echo Users::model()->getUserName($model->user_ID); ?>
 voor de Hike:<?php echo EventNames::model()->getEventName($model->event_ID); ?>
 </h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>