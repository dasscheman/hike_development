<?php

?>


<div class="view">
<!--
	<b><?php /*echo CHtml::encode($data->getAttributeLabel('deelnemers_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->deelnemers_ID), array('view', 'id'=>$data->deelnemers_ID)); */?>
	<br />
-->
	<b><?php echo CHtml::encode($data->getAttributeLabel('event_ID')); ?>:</b>
	<?php //echo CHtml::encode($data->event_ID);
          echo CHtml::link(CHtml::encode(EventNames::model()->getEventName($data->event_ID)),
          array('/game/gameOverview',
                'event_id'=>$data->event_ID, ));?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_ID')); ?>:</b>
	<?php //echo CHtml::encode($data->user_ID);
          echo CHtml::encode(Users::model()->getUserName($data->user_ID))?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rol')); ?>:</b>
	<?php //echo CHtml::encode($data->rol);
          echo CHtml::encode(DeelnemersEvent::model()->getRolText($data->rol)); ?>
	<br />
	<?php
	if($data->rol == 2)
	{ ?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('group_ID')); ?>:</b>
	<?php //echo CHtml::encode($data->group_ID);
          echo CHtml::encode(Groups::model()->getGroupName($data->group_ID));?>
	<br />
	<?php } ?>

<!--
	<b><?php /*echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_user_ID')); ?>:</b>
	<?php echo CHtml::encode($data->create_user_ID); ?>
	<br />

	<?php
	<b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
	<?php echo CHtml::encode($data->update_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_user_ID')); ?>:</b>
	<?php echo CHtml::encode($data->update_user_ID); ?>
	<br />

	*/ ?>
-->
</div>