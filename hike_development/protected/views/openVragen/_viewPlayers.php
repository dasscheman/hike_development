<?php
/* @var $this OpenVragenController */
/* @var $data OpenVragen */
?>

<div class="view">
<!--
	<b><?php //echo CHtml::encode($data->getAttributeLabel('open_vragen_ID')); ?>:</b>
	<?php //echo CHtml::encode($data->open_vragen_ID); ?>
	<br />
-->

    <div class="row buttons">

    <?php
        if(OpenVragenAntwoorden::model()->isActionAllowed('openVragenAntwoorden',
												'create',
												$data->event_ID,
												"", //model_id
												$_GET['group_id']) &&
			OpenVragenAntwoorden::model()->isVraagBeantwoord($data->event_ID,
                                                            $_GET['group_id'],
                                                            $data->open_vragen_ID) == 'Nee')
        {
				echo CHtml::link('<span class="fa-stack fa-lg">
										<i class="fa fa-circle fa-stack-2x fa-green"></i>
										<i class="fa fa-file-o fa-stack-1x"></i>
										<i class="fa fa-blue fa-text-right fa-09x"> Beantwoorden</i>
										<i class="fa fa-pencil fa-stack-up-15p fa-blue fa-06x"> </i>
								  </span>',
								 array('/openVragenAntwoorden/create',
                                       'event_id'=>$data->event_ID,
                                       'group_id'=>$_GET['group_id'],
                                       'vraag_id'=>$data->open_vragen_ID));
        }
		else
        {   if(OpenVragenAntwoorden::model()->isActionAllowed('openVragenAntwoorden',
												'update',
												$data->event_ID,
												"", //model_id
												$_GET['group_id']) &&
			   OpenVragenAntwoorden::model()->isVraagGecontroleerd($data->event_ID,
                                                                   $_GET['group_id'],
                                                                   $data->open_vragen_ID) == 'Nee')
            {
				echo CHtml::link('<span class="fa-stack fa-lg">
										<i class="fa fa-circle fa-stack-2x fa-green"></i>
										<i class="fa fa-file-o fa-stack-1x"></i>
										<i class="fa fa-blue fa-text-right fa-09x"> Bewerken</i>
										<i class="fa fa-refresh fa-stack-up-15p fa-blue fa-06x"> </i>
								  </span>',
								  array('/openVragenAntwoorden/update',
										'event_id'=>$data->event_ID,
										'group_id'=>$_GET['group_id'],
										'vraag_id'=>$data->open_vragen_ID));
        }} ?>
    </div> <!-- end row buttons-->
<!--
	<b><?php //echo CHtml::encode('Vraag Nummer'); ?>:</b>
	<?php //echo CHtml::encode(OpenVragen::model()->getVraagVolgorde($data->open_vragen_ID)); ?>
	<br />
-->

	<b><?php echo CHtml::encode($data->getAttributeLabel('open_vragen_name')); ?>:</b>
	<?php echo CHtml::encode($data->open_vragen_name); ?>
	<br />

	<b><?php echo CHtml::encode('Hike Dag'); ?>:</b>
	<?php echo CHtml::encode(OpenVragen::model()->getVraagDag($data->open_vragen_ID)); ?>
	<br />

	<b><?php echo CHtml::encode('Route Onderdeel'); ?>:</b>
	<?php echo CHtml::encode(OpenVragen::model()->getRouteOnderdeelVraag($data->open_vragen_ID)); ?>
	<br />

<!--
	<b><?php //echo CHtml::encode($data->getAttributeLabel('event_ID')); ?>:</b>
	<?php //echo CHtml::encode($data->event_ID);
         // echo CHtml::encode(EventNames::model()->getEventName($data->event_ID));?>
	<br />


	<b><?php //echo CHtml::encode($data->getAttributeLabel('day_ID')); ?>:</b>
	<?php //echo CHtml::encode($data->day_ID); ?>
	<br />

	<b><?php //echo CHtml::encode($data->getAttributeLabel('route_techniek_ID')); ?>:</b>
	<?php //echo CHtml::encode($data->route_techniek_ID); ?>
	<br />
<
	<b><?php //echo CHtml::encode($data->getAttributeLabel('vraag_volgorde')); ?>:</b>
	<?php //echo CHtml::encode($data->vraag_volgorde); ?>
	<br />
-->
<!--	<b><?php //echo CHtml::encode($data->getAttributeLabel('omschrijving')); ?>:</b>
	<?php //echo CHtml::encode($data->omschrijving); ?>
	<br />
	-->
	<b><?php echo CHtml::encode($data->getAttributeLabel('vraag')); ?>:</b>
	<?php echo CHtml::encode($data->vraag); ?>
        <br />

<table>
    <td>
	<b><?php echo CHtml::encode($data->getAttributeLabel('score')); ?>:</b>
	<?php echo CHtml::encode($data->score); ?>
	<br />

        <b><?php echo CHtml::encode('Beantwoord'); ?>:</b>
	<?php echo CHtml::encode(OpenVragenAntwoorden::model()->isVraagBeantwoord($data->event_ID,
                                                                                  $_GET['group_id'],
                                                                                  $data->open_vragen_ID)); ?>
	<br />
    </td>
    <td>
        <b><?php echo CHtml::encode('Gecontroleerd'); ?>:</b>
	<?php echo CHtml::encode(OpenVragenAntwoorden::model()->isVraagGecontroleerd($data->event_ID,
                                                                                     $_GET['group_id'],
                                                                                     $data->open_vragen_ID)); ?>
	<br />
        <b><?php echo CHtml::encode('Goed'); ?>:</b>
	<?php echo CHtml::encode(OpenVragenAntwoorden::model()->isVraagGoed($data->event_ID,
                                                                            $_GET['group_id'],
                                                                            $data->open_vragen_ID)); ?>
        <br />
    </td>
</table>
<!--
	<b><?php /*echo CHtml::encode($data->getAttributeLabel('goede_antwoord')); ?>:</b>
	<?php echo CHtml::encode($data->goede_antwoord); ?>
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