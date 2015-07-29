<?php

?>


<div class="view">
	<b><?php echo CHtml::encode($data->getAttributeLabel('event_ID')); ?>:</b>
	<?php //echo CHtml::encode($data->event_ID); 
          echo CHtml::link(CHtml::encode(EventNames::model()->getEventName($data->event_ID)), 
          array('/chart/viewChart', 
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
</div>