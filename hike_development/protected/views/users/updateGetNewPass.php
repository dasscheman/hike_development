<?php
// Created: 2014
// Modified: 22 feb 2015

/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Profiel'=>array('/game/viewUser'),
);
?>

<h1>Geef je gebruikersnaam en je email, dan krijg je een nieuw wachtwoord.</h1>

<?php echo $this->renderPartial('_formGetNewPass', array('model'=>$model)); ?>