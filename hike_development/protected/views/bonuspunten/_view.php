<?php
/* @var $this BonuspuntenController */
/* @var $data Bonuspunten */
?>

<div class="view">
<!--
	<b><?php //echo CHtml::encode($data->getAttributeLabel('bouspunten_ID')); ?>:</b>
	<?php //echo CHtml::link(CHtml::encode($data->bouspunten_ID), array('view', 'id'=>$data->bouspunten_ID)); ?>
	<br />

	<b><?php //echo CHtml::encode($data->getAttributeLabel('event_ID')); ?>:</b>
	<?php //echo CHtml::encode($data->event_ID); ?>
	<br />
-->
<?php
    if (Bonuspunten::model()->isActionAllowed('bonuspunten', 'update', $data->event_ID)) {
        echo CHtml::link('<span class="fa-stack fa-lg">
                                <i class="fa fa-pencil fa-stack-1x"></i>
                                <i class="fa fa-blue fa-text-right fa-07x"> Wijzigen </i>
                          </span>',
                          array('bonuspunten/update',
                                'id'=>$data->bouspunten_ID,
                                'event_id'=>$data->event_ID,
                                'group_id'=>$data->group_ID)); 
    }  ?>
        <br />                                  
	<b><?php echo CHtml::encode($data->getAttributeLabel('group_ID')); ?>:</b>
	<?php echo CHtml::encode(Groups::model()->getGroupName($data->group_ID)); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('post_ID')); ?>:</b>
	<?php echo CHtml::encode(Posten::model()->getPostName($data->post_ID));?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('omschrijving')); ?>:</b>
	<?php echo CHtml::encode($data->omschrijving); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('score')); ?>:</b>
	<?php echo CHtml::encode($data->score); ?>
	<br />


	<?php /*
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
	<?php echo CHtml::encode($data->update_user_ID); ?>
	<br />

	*/ ?>

</div>