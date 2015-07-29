<?php
/* @var $this PostPassageController */
/* @var $data PostPassage */
?>

<div class="view">
<!--
	<b><?php //echo CHtml::encode($data->getAttributeLabel('posten_passage_ID')); ?>:</b>
	<?php //echo CHtml::link(CHtml::encode($data->posten_passage_ID), array('view', 'id'=>$data->posten_passage_ID)); ?>
	<br />
-->
<table> <td>
	<b><?php echo CHtml::encode($data->getAttributeLabel('post_ID')); ?>:</b>
	<?php //echo CHtml::encode($data->post_ID); 
          echo CHtml::encode(Posten::model()->getPostName($data->post_ID));?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('event_ID')); ?>:</b>
	<?php //echo CHtml::encode($data->event_ID); 
          echo CHtml::encode(EventNames::model()->getEventName($data->event_ID));?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day_ID')); ?>:</b>
	<?php //echo CHtml::encode($data->day_ID);  
          echo CHtml::encode(DayNames::model()->getDayName($data->day_ID));?>
	<br />
</td>
<td>
	<b><?php echo CHtml::encode($data->getAttributeLabel('group_ID')); ?>:</b>
	<?php //echo CHtml::encode($data->group_ID); 
          echo CHtml::encode(Groups::model()->getGroupName($data->group_ID));?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gepasseerd')); ?>:</b>
	<?php //echo CHtml::encode($data->gepasseerd); 
          echo CHtml::encode(GeneralFunctions::getJaNeeText($data->gepasseerd));?>
	<br/>
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('binnenkomst')); ?>:</b>
	<?php echo CHtml::encode($data->binnenkomst); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vertrek')); ?>:</b>
	<?php echo CHtml::encode($data->vertrek); ?>
	<br />

  </td>
  
   <table>
    
	<b><?php echo CHtml::encode($data->getAttributeLabel('score')); ?>:</b>
	<?php echo CHtml::encode($data->score); ?>
	<br />
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
	

</div>