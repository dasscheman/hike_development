<?php
/* @var $this DeelnemersEventController */
/* @var $data DeelnemersEvent */
// Created: 2014
// Last modified: 19 jan 2015
?>

<div class="view">
	<b><?php echo CHtml::encode($data->getAttributeLabel('user_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode(Users::model()->getUserName($data->user_ID)),
			   array('/deelnemersEvent/update',
				 'event_id'=>$data->event_ID,
				 'id'=>$data->deelnemers_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rol')); ?>:</b>
	<?php echo CHtml::encode(DeelnemersEvent::model()->getRolText($data->rol)); ?>
	<br />
	<?php

    if($data->rol == 2)
	{
		?>
		<b><?php echo CHtml::encode($data->getAttributeLabel('group_ID')); ?>:</b>
		<?php echo CHtml::encode(Groups::model()->getGroupName($data->group_ID));?>
		<br />
		<?php ;
	} ?>
</div>