<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Admin Panel'=>array('admin/index'),
	'Gebruikers'=>array('users/index'),
);
/*
$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Manage Users', 'url'=>array('admin')),
);*/
?>

<h1>Gebruiker Toevoegen</h1>
<h4>Na het invullen en submitten van je gegevens krijg een email met je wachtwoord.</h4>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>