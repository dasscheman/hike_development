<?php
// Created: 2014
// Modified: 26 jan 2015

/* @var $this OpenVragenAntwoordenController */
/* @var $data OpenVragenAntwoorden */
?>

<div class="view">
	<b><?php echo CHtml::encode($data->getAttributeLabel('group_ID')); ?>:</b>
	<?php echo CHtml::encode(Groups::model()->getGroupName($data->group_ID)); ?>
	<br />

	<b><?php echo CHtml::encode('Vraag'); ?>:</b>
	<?php echo CHtml::encode(OpenVragen::model()->getOpenVraag($data->open_vragen_ID)); ?>
	<br />
	
	<b><?php echo CHtml::encode('Goede Antwoord'); ?>:</b>
	<?php echo CHtml::encode(OpenVragen::model()->getOpenVraagAntwoord($data->open_vragen_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('antwoord_spelers')); ?>:</b>
	<b><?php echo CHtml::encode($data->antwoord_spelers); ?></b>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('checked')); ?>:</b>
	<?php echo CHtml::encode(GeneralFunctions::getJaNeeText($data->checked)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('correct')); ?>:</b>
	<?php echo CHtml::encode(GeneralFunctions::getJaNeeText($data->correct));?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_user_ID')); ?>:</b>
	<?php echo CHtml::encode(Users::model()->getUserName($data->create_user_ID)); ?>
	<br />

	<div class="row buttons">
	<?php	
			echo CHtml::link('<span class="fa-stack fa-lg">
								<i class="fa fa-circle fa-stack-2x fa-green"></i>
								<i class="fa fa-file-o fa-stack-1x"></i>
								<i class="fa fa-times fa-stack-40p fa-blue fa-06x"></i>
							  </span>', 
							  array('/openVragenAntwoorden/antwoordGoedOfFout',
								    'id'=>$data->open_vragen_antwoorden_ID,
								    'goedfout'=>0,
								    'event_id'=>$_GET['event_id'])); 

			echo CHtml::link('<span class="fa-stack fa-lg">
								<i class="fa fa-circle fa-stack-2x fa-green"></i>
								<i class="fa fa-file-o fa-stack-1x"></i>
								<i class="fa fa-check fa-stack-40p fa-blue fa-06x"> </i>
							  </span>', 
							  array('/openVragenAntwoorden/antwoordGoedOfFout',
								       'id'=>$data->open_vragen_antwoorden_ID,
								       'goedfout'=>1,
								       'event_id'=>$_GET['event_id']));?>
		
	</div>

</div>