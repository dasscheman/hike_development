<?php
/* @var $this QrCheckController */
/* @var $model QrCheck */

$this->breadcrumbs=array(
	'Qr Checks'=>array('index'),
	$model->qr_check_ID=>array('view','id'=>$model->qr_check_ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List QrCheck', 'url'=>array('index')),
	array('label'=>'Create QrCheck', 'url'=>array('create')),
	array('label'=>'View QrCheck', 'url'=>array('view', 'id'=>$model->qr_check_ID)),
	array('label'=>'Manage QrCheck', 'url'=>array('admin')),
);
?>

<h1>Update QrCheck <?php echo $model->qr_check_ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>