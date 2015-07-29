<?php
// Created: 2014
// Modified: 26 jan 2015

/* @var $this OpenVragenAntwoordenController */
/* @var $data OpenVragenAntwoorden */
?>

<div class="view">

           
<table>
  <td>    
  
<!--	<b><?php //echo CHtml::encode($data->getAttributeLabel('open_vragen_antwoorden_ID')); ?>:</b>
	<?php //echo CHtml::link(CHtml::encode($data->open_vragen_antwoorden_ID), array('view', 'id'=>$data->open_vragen_antwoorden_ID)); ?>
	<br />
-->
    <?php   
	if(OpenVragenAntwoorden::model()->isActionAllowed('openVragenAntwoorden', 'update', $data->event_ID))
            {
				echo CHtml::link('<span class="fa-stack fa-lg">
										<i class="fa fa-circle fa-stack-2x fa-green"></i>
										<i class="fa fa-file-o fa-stack-1x"></i>
										<i class="fa fa-blue fa-text-right fa-09x"> Bewerken</i>
										<i class="fa fa-refresh fa-stack-up-15p fa-blue fa-06x"> </i>
								  </span>', 
								  array('/openVragenAntwoorden/updateOrganisatie',
										'event_id'=>$data->event_ID,
										'group_id'=>$data->group_ID,
										'vraag_id'=>$data->open_vragen_ID));
			} ?>
		<br />		
<!--	<b><?php //echo CHtml::encode('Vraag Nummer'); ?>:</b>
	<?php //echo CHtml::encode(OpenVragen::model()->getVraagVolgorde($data->open_vragen_ID)); ?>
	<br />
	-->
	<b><?php echo CHtml::encode('Hike Dag'); ?>:</b>
	<?php echo CHtml::encode(OpenVragen::model()->getVraagDag($data->open_vragen_ID)); ?>
	<br />
	
	<b><?php echo CHtml::encode('Route Onderdeel'); ?>:</b>
	<?php echo CHtml::encode(OpenVragen::model()->getRouteOnderdeelVraag($data->open_vragen_ID)); ?>
	<br />
	
	<b><?php echo CHtml::encode('Vraag Omschrijving'); ?>:</b>
	<?php echo CHtml::encode(OpenVragen::model()->getOpenVragenName($data->open_vragen_ID)); ?>
	<br />	

	<b><?php echo CHtml::encode($data->getAttributeLabel('checked')); ?>:</b>
	<?php echo CHtml::encode(GeneralFunctions::getJaNeeText($data->checked)); ?>
	<br />
  </td>
  <td>


<!--
	<b><?php //echo CHtml::encode($data->getAttributeLabel('event_ID')); ?>:</b>
	<?php //echo CHtml::encode($data->event_ID); ?>
	<br />
	-->
	<b><?php echo CHtml::encode($data->getAttributeLabel('group_ID')); ?>:</b>
	<?php echo CHtml::encode(Groups::model()->getGroupName($data->group_ID)); ?>
	<br />

	<b><?php echo CHtml::encode('Vraag'); ?>:</b>
	<?php echo CHtml::encode(OpenVragen::model()->getOpenVraag($data->open_vragen_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('antwoord_spelers')); ?>:</b>
	<?php echo CHtml::encode($data->antwoord_spelers); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('correct')); ?>:</b>
	<?php echo CHtml::encode(GeneralFunctions::getJaNeeText($data->correct)); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('create_user_ID')); ?>:</b>
	<?php echo CHtml::encode(Users::model()->getUserName($data->create_user_ID)); ?>
	<br />
	
  </td>
</table>
	

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('score')); ?>:</b>
	<?php echo CHtml::encode($data->score); ?>
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
	<?php echo CHtml::encode($data->update_user_ID); ?>
	<br />

	*/ ?>

</div>