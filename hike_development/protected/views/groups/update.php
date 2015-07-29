<?php
/* @var $this GroupsController */
/* @var $model Groups */

$this->breadcrumbs=array(
	'Startup Spel Overzicht'=>array('/startup/startupOverview','event_id'=>$model->event_ID),
);

$this->menu=array(
        array('label'=>'Groep Toevoegen', 'url'=>array('/groups/create', 'event_id'=>$model->event_ID)),
	array('label'=>'Verwijder deze groep',
              'url'=>'#',
              'linkOptions'=>array('submit'=>array('delete',
                                                   'id'=>$model->group_ID,
                                                   'event_id'=>$model->event_ID),
                                   'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>Bijwerken van groepsnaam</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>