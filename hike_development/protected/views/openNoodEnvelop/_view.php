<?php
// Created: 2014
// Modified: 26 jan 2015

/* @var $this OpenNoodEnvelopController */
/* @var $data OpenNoodEnvelop */
?>

<div class="view">
<table>
	<td>

<?php
	if(OpenNoodEnvelop::model()->isActionAllowed('openNoodEnvelop', 'update', $data->event_ID)) {
		echo CHtml::link('<span class="fa-stack fa-lg">
							<i class="fa fa-pencil fa-stack-1x"></i>
							<i class="fa fa-blue fa-text-right fa-07x"> Wijzigen </i>
					  </span>',
					  array('openNoodEnvelop/update',
							'id'=>$data->open_nood_envelop_ID,
							'event_id'=>$data->event_ID,
							'group_id'=>$data->group_ID));
	}?><br />
<!--	<b><?php // echo CHtml::encode('Noodenvelop Nummer'); ?>:</b>
	<?php //echo CHtml::encode(NoodEnvelop::model()->getNoodEnvelopVolgnummer($data->nood_envelop_ID)); ?>
	<br />
	-->
	<b><?php echo CHtml::encode('Noodenvelop'); ?>:</b>
	<?php echo CHtml::encode(NoodEnvelop::model()->getNoodEnvelopName($data->nood_envelop_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('group_ID')); ?>:</b>
	<?php echo CHtml::encode(Groups::model()->getGroupName($data->group_ID)); ?>
	<br />


	<b><?php echo CHtml::encode('Dag'); ?>:</b>
	<?php echo CHtml::encode(NoodEnvelop::model()->getEventDayOfEnvelop($data->nood_envelop_ID)); ?>
	<br />
	
	<b><?php echo CHtml::encode('Route Onderdeel'); ?>:</b>
	<?php echo CHtml::encode(NoodEnvelop::model()->getRouteNameOfEnvelopId($data->nood_envelop_ID)); ?>
	<br />
	</td>
	<td>
	<b><?php echo CHtml::encode('Coordinaten'); ?>:</b>
	<?php echo CHtml::encode(NoodEnvelop::model()->getCoordinaten($data->nood_envelop_ID)); ?>
	<br />
	<b><?php echo CHtml::encode('Opmerkingen'); ?>:</b>
	<?php echo CHtml::encode(NoodEnvelop::model()->getOpmerkingen($data->nood_envelop_ID)); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('opened')); ?>:</b>
	<?php echo CHtml::encode(GeneralFunctions::getJaNeeText($data->opened)); ?>
	<br />

	<b><?php echo CHtml::encode('Score'); ?>:</b>
	<?php echo CHtml::encode(NoodEnvelop::model()->getNoodEnvelopScore($data->nood_envelop_ID)); ?>
	<br />

	<b><?php echo CHtml::encode('Geopend op'); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_user_ID')); ?>:</b>
	<?php echo CHtml::encode(Users::model()->getUserName($data->create_user_ID)); ?>
	<br />
	
	</td>
</table>
</div>