<?php
/* @var $this PostenController */
/* @var $model Posten */

$this->breadcrumbs=array(
	'Startup Spel Overzicht'=>array('/startup/startupOverview','event_id'=>$model->event_ID),
);

$this->menu=array(
        array('label'=>'Post Toevoegen', 'url'=>array('/Posten/create', 'event_id'=>$model->event_ID)),
	array('label'=>'Verwijder deze Post',
              'url'=>'#',
              'linkOptions'=>array('submit'=>array('delete',
                                                   'id'=>$model->post_ID,
                                                   'event_id'=>$model->event_ID),
                                   'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>Bijwerken van post <?php echo Posten::model()->getPostName($model->post_ID); ?>
 voor hike: <?php echo EventNames::model()->getEventName($model->event_ID); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>