<?php
/* @var $this QrCheckController */
/* @var $model QrCheck */

$this->breadcrumbs=array(
	'Qr Checks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List QrCheck', 'url'=>array('index')),
	array('label'=>'Manage QrCheck', 'url'=>array('admin')),
);
?>

<h1>Create QrCheck</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>