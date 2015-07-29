<?php
// Created: 2014
// Modified: 11 jan 2015

/* @var $this PostenController */
/* @var $data Posten */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('post_name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->post_name),
			       array('posten/update',
				     'event_id'=>$data->event_ID,
				     'id'=>$data->post_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date);?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('post_volgorde')); ?>:</b>
	<?php echo CHtml::encode($data->post_volgorde); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('score')); ?>:</b>
	<?php echo CHtml::encode($data->score); ?>
	<br />
</div>