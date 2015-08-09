<?php
/* @var $this QrCheckController */
/* @var $data QrCheck */
?>

<div class="view">
<!--
	<b><?php //echo CHtml::encode($data->getAttributeLabel('qr_check_ID')); ?>:</b>
	<?php //echo CHtml::link(CHtml::encode($data->qr_check_ID), array('view', 'id'=>$data->qr_check_ID)); ?>
	<br />
-->
	<b><?php echo CHtml::encode('Stille Post Naam'); ?>:</b>
	<?php echo CHtml::encode(Qr::model()->getQrCodeName($data->event_ID, $data->qr_ID)); ?>
	<br />
<!--
	<b><?php //echo CHtml::encode($data->getAttributeLabel('event_ID')); ?>:</b>
	<?php //echo CHtml::encode($data->event_ID); ?>
	<br />

	<b><?php //echo CHtml::encode($data->getAttributeLabel('group_ID')); ?>:</b>
	<?php //echo CHtml::encode($data->group_ID); ?>
	<br />
-->
	<b><?php echo CHtml::encode('Score'); ?>:</b>
	<?php echo CHtml::encode(Qr::model()->getQrScore($data->qr_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_user_ID')); ?>:</b>
	<?php echo CHtml::encode(Users::model()->getUserName($data->create_user_ID)); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
	<?php echo CHtml::encode($data->update_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_user_ID')); ?>:</b>
	<?php echo CHtml::encode($data->update_user_ID); ?>
	<br />

	*/ ?>

</div>