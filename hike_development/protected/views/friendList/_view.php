<?php
/* @var $this FriendListController */
/* @var $data FriendList */
?>

<div class="view">
<!--
	<b><?php //echo CHtml::encode($data->getAttributeLabel('friend_list_ID')); ?>:</b>
	<?php //echo CHtml::link(CHtml::encode($data->friend_list_ID), array('view', 'id'=>$data->friend_list_ID)); ?>
	<br />

	<b><?php //echo CHtml::encode($data->getAttributeLabel('user_ID')); ?>:</b>
	<?php //echo CHtml::encode($data->user_ID); ?>
	<br />
-->
	<b><?php echo CHtml::encode($data->getAttributeLabel('friends_with_user_ID')); ?>:</b>
	<?php echo CHtml::encode(Users::model()->getUserName($data->friends_with_user_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode(FriendList::model()->getStatusText2($data->status)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />
<!--
	<b><?php //echo CHtml::encode($data->getAttributeLabel('create_user_ID')); ?>:</b>
	<?php //echo CHtml::encode($data->create_user_ID); ?>
	<br />

	<b><?php //echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
	<?php //echo CHtml::encode($data->update_time); ?>
	<br />
-->
	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('update_user_ID')); ?>:</b>
	<?php echo CHtml::encode($data->update_user_ID); ?>
	<br />

	*/ ?>

</div>