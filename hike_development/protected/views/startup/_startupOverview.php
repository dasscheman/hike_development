<?php
// Created: 2014
// Modified: 4 jan 2015

/* @var $this GroupsController */
/* @var $data Groups */

?>

<div class="view">
   <table> <td>
<!--
	<b><?php //echo CHtml::encode($data->getAttributeLabel('group_ID')); ?>:</b>
	<?php //echo CHtml::link(CHtml::encode($data->group_ID), array('view', 'id'=>$data->group_ID)); ?>
	<br />
-->
	<b><?php echo CHtml::encode($data->getAttributeLabel('event_ID')); ?>:</b>
	<?php //echo CHtml::encode($data->event_ID); 
	       echo CHtml::encode(EventNames::model()->getEventName($data->event_ID));?>
	<br />

	
	<b><?php echo CHtml::encode($data->getAttributeLabel('group_name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->group_name), 
                           array('groupoverview', 
                                 'event_id'=>$data->event_ID, 
                                 'group_id'=>$data->group_ID)); ?>
	<br />
<!--	
	<b><?php /*echo CHtml::encode('Binnenkomst Laatste Post'); ?>:</b>
	<?php echo CHtml::encode($data->group_name); ?>
	<br />
	
	<b><?php echo CHtml::encode('Score Posten'); ?>:</b>
	<?php echo CHtml::encode($data->group_name); ?>
	<br />
	
	<b><?php echo CHtml::encode('Score Vragen'); ?>:</b>
	<?php echo CHtml::encode($data->group_name); ?>
	<br />

    </td><td>
	
	<b><?php echo CHtml::encode('Score Paddestoelen'); ?>:</b>
	<?php echo CHtml::encode($data->group_name); ?>
	<br />
	
	<b><?php echo CHtml::encode('Score Bonuspunten'); ?>:</b>
	<?php echo CHtml::encode($data->group_name); ?>
	<br />


	<b><?php echo CHtml::encode('Total score'); ?>:
	<?php echo CHtml::encode($data->group_name); ?></b>
	<br />
--


<!--
	<b><?php /*echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_user_ID')); ?>:</b>
	<?php echo CHtml::encode($data->create_user_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
	<?php echo CHtml::encode($data->update_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_user_ID')); ?>:</b>
	<?php echo CHtml::encode($data->update_user_ID); */?>
	<br />
-->

</td></table>
</div>