<?php
/* @var $this EventNamesController */
/* @var $model EventNames */

$this->breadcrumbs=array(
	'Admin Panel'=>array('admin/index'),
	'Hiken'=>array('eventNames/index'),
);

$this->menu=array(
	array('label'=>'Hike toevoegen', 'url'=>array('create')),
	array('label'=>'Hiken beheren', 'url'=>array('admin')),
	array('label'=>'Hike verwijderen',
	      'url'=>'#',
	      'linkOptions'=>array('submit'=>array('delete',
						   'id'=>$model->event_ID),
				   'confirm'=>'Weet je zeker dat je deze Hike wilt verwijderen?')),
);
?>

<h1>Logo voor hike <?php echo $model->event_ID; ?> bijwerken</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>