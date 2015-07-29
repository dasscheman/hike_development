<?php
/* @var $this EventNamesController */
/* @var $model EventNames */

$this->breadcrumbs=array(
	'Admin Panel'=>array('admin/index'),
	'Hiken'=>array('eventNames/index'),
);

$this->menu=array(
	array('label'=>'Hike toevoegen', 'url'=>array('create')),
	array('label'=>'Hike bewerken', 'url'=>array('update', 'id'=>$model->event_ID)),
	array('label'=>'Hike verwijderen',
	      'url'=>'#',
	      'linkOptions'=>array('submit'=>array('delete',
						   'id'=>$model->event_ID),
				   'confirm'=>'Weet je zeker dat je deze Hike wilt verwijderen?')),
	array('label'=>'Hiken beheren', 'url'=>array('admin')),
	array('label'=>'Gebruikers aan hike toevoegen', 'url'=>array('deelnemersEvent/adminCreate', 'event_id'=>$model->event_ID)),
);
?>

<h1>Gegevens van hike: <?php echo $model->event_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'event_ID',
		'event_name',
		'start_date',
		'end_date',
        array(            
            'label'=>'Status',
            'type'=>'raw',
            'value'=>$model->getStatusText()),
		//'create_time',
		//'create_user_ID',
		//'update_time',
		//'update_user_ID',
	),
)); ?>
