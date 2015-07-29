<?php
/* @var $this RouteController */
/* @var $data Route */
?>

<div class="view">
<!--
	<b><?php /*echo CHtml::encode($data->getAttributeLabel('route_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->route_ID), array('view', 'id'=>$data->route_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('event_ID')); ?>:</b>
	<?php echo CHtml::encode($data->event_ID); */?>
	<br />
-->
	<b><?php echo CHtml::encode($data->getAttributeLabel('day_date')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->day_date),
			       array('route/update',
				     'event_id'=>$data->event_ID,
				     'id'=>$data->route_ID)); ?>
	<br />

<!--
	<b><?php /*echo CHtml::encode($data->getAttributeLabel('route_volgorde')); ?>:</b>
	<?php echo CHtml::encode($data->route_volgorde); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
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

</div>