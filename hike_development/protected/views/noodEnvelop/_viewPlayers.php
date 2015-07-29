<?php
/* @var $this NoodEnvelopController */
/* @var $data NoodEnvelop */
?>

<div class="view">
<!--
	<b><?php //echo CHtml::encode($data->getAttributeLabel('nood_envelop_ID')); ?>:</b>
	<?php //echo CHtml::link(CHtml::encode($data->nood_envelop_ID), array('view', 'id'=>$data->nood_envelop_ID)); ?>
	<br />
-->
    <div class="row buttons">
       
    <?php   
	if(!OpenNoodEnvelop::model()->isEnvelopOpenByGroup($data->nood_envelop_ID,
								  $_GET['event_id'],
								  $_GET['group_id']))
        {
		       echo CHtml::button('OPENEN',
					  array('submit' => array('/openNoodEnvelop/create',
					      'nood_envelop_id'=>$data->nood_envelop_ID,
					      'event_id'=>$_GET['event_id'],
					      'group_id'=>$_GET['group_id'])),
					array('confirm'=>'Weet je zeker dat je deze envelop open wilt maken?'));
		       } ?>
    </div> <!-- end row buttons-->

	<b><?php echo CHtml::encode($data->getAttributeLabel('nood_envelop_name')); ?>:</b>
	<?php echo CHtml::encode($data->nood_envelop_name); ?>
	<br />
<!--
	<b><?php //echo CHtml::encode($data->getAttributeLabel('event_ID')); ?>:</b>
	<?php //echo CHtml::encode($data->event_ID); ?>
	<br />
-->

        <b><?php echo CHtml::encode('Geopend'); ?>:</b>
	<?php if(OpenNoodEnvelop::model()->isEnvelopOpenByGroup($data->nood_envelop_ID,
								  $_GET['event_id'],
								  $_GET['group_id']))
                {
		       echo CHtml::encode('Ja');
		}
		else
		{
		       echo CHtml::encode('Nee');
		}
		?>						
	<br />

<!--	
        <b><?php //echo CHtml::encode($data->getAttributeLabel('nood_envelop_volgorde')); ?>:</b>
	<?php //echo CHtml::encode($data->nood_envelop_volgorde); ?>
	<br />
	-->
	<b><?php echo CHtml::encode($data->getAttributeLabel('route_ID')); ?>:</b>
	<?php echo CHtml::encode(Route::model()->getRouteName($data->route_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Dag')); ?>:</b>
	<?php echo CHtml::encode(Route::model()->getDayOfRouteId($data->route_ID)); ?>
	<br />
<!--
	<b><?php //echo CHtml::encode($data->getAttributeLabel('coordinaat')); ?>:</b>
	<?php //echo CHtml::encode($data->coordinaat); ?>
	<br />

	<b><?php //echo CHtml::encode($data->getAttributeLabel('opmerkingen')); ?>:</b>
	<?php //echo CHtml::encode($data->opmerkingen); ?>
	<br />
-->
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