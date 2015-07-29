<?php
/* @var $this UsersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Admin Panel'=>array('admin/index'),
);

$this->menu=array(
	array('label'=>'Gebruiker toevoegen', 'url'=>array('create')),
	array('label'=>'Gebruikers beheren', 'url'=>array('admin')),
);
?>

<h1>Gebruikers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
