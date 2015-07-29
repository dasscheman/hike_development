<?php
// Created: 2014
// Modified: 22 feb 2015

/* @var $this UsersController */
/* @var $data Users */
?>

<div class="view">

	<?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:
	<b><?php echo CHtml::encode($data->username); ?></b>
	<br />

	<?php echo CHtml::encode($data->getAttributeLabel('voornaam')); ?>:
	<b><?php echo CHtml::encode($data->voornaam); ?></b>
	<br />

	<?php echo CHtml::encode($data->getAttributeLabel('achternaam')); ?>:
	<b><?php echo CHtml::encode($data->achternaam); ?></b>
	<br />

	<?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:
	<b><?php echo CHtml::encode($data->email); ?></b>
	<br />

	<?php echo CHtml::encode($data->getAttributeLabel('birthdate')); ?>:
	<b><?php echo CHtml::encode($data->birthdate); ?></b>
	<br />

	<?php echo CHtml::encode($data->getAttributeLabel('last_login_time')); ?>:
	<b><?php echo CHtml::encode($data->last_login_time); ?></b>
	<br />

	<?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:
	<b><?php echo CHtml::encode($data->create_time); ?></b>
	<br />
</div>