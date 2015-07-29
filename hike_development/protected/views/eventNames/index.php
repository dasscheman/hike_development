<?php
/* @var $this EventNamesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Admin Panel'=>array('admin/index'),
);


$this->menu=array(
	array('label'=>'Hike aanmaken', 'url'=>array('create')),
	array('label'=>'Hiken beheren', 'url'=>array('admin')),
);
?>

<h1>Hiken</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
