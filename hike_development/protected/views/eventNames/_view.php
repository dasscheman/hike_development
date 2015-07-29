<?php
/* @var $this EventNamesController */
/* @var $data EventNames */
?>

<div class="view">
<!--
	<b><?php //echo CHtml::encode($data->getAttributeLabel('event_ID')); ?>:</b>
	<?php //echo CHtml::link(CHtml::encode($data->event_ID), array('view', 'id'=>$data->event_ID)); ?>
	<br />
-->
	<b><?php echo CHtml::encode($data->getAttributeLabel('event_name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->event_name), array('view', 'id'=>$data->event_ID));?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('start_date')); ?>:</b>
	<?php echo CHtml::encode($data->start_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('end_date')); ?>:</b>
	<?php echo CHtml::encode($data->end_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php //echo CHtml::encode($data->status); 
	      echo CHtml::encode($data->getStatusText()); ?>
	<br />
<!--
	<b><?php //echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php //echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php //echo CHtml::encode($data->getAttributeLabel('create_user_ID')); ?>:</b>
	<?php //echo CHtml::encode($data->create_user_ID); ?>
	<br />
-->
	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
	<?php echo CHtml::encode($data->update_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_user_ID')); ?>:</b>
	<?php echo CHtml::encode($data->update_user_ID); ?>
	<br />

	*/ ?>

</div>