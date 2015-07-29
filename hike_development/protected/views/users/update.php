<?php
// Created: 2014
// Modified: 22 feb 2015

/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Profiel'=>array('/game/viewUser'),
);
?>

<h1>Gebruiker <?php echo $model->username; ?> bijwerken</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>