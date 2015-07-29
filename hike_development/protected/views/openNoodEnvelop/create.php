<?php
/* @var $this OpenNoodEnvelopController */
/* @var $model OpenNoodEnvelop */

$this->breadcrumbs=array(
	'Open Nood Envelops'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List OpenNoodEnvelop', 'url'=>array('index')),
	array('label'=>'Manage OpenNoodEnvelop', 'url'=>array('admin')),
);
?>

<h1>Create OpenNoodEnvelop</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>