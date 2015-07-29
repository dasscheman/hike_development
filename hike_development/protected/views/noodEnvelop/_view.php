<?php
// Created: 2014
// Modified: 10 jan 2014

/* @var $this NoodEnvelopController */
/* @var $data NoodEnvelop */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('nood_envelop_name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->nood_envelop_name),
			       array('/noodEnvelop/update',
				     'nood_envelop_id'=>$data->nood_envelop_ID,
				     'event_id'=>$data->event_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('coordinaat')); ?>:</b>
	<?php echo CHtml::encode($data->coordinaat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('opmerkingen')); ?>:</b>
	<?php echo CHtml::encode($data->opmerkingen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('score')); ?>:</b>
	<?php echo CHtml::encode($data->score); ?>
	<br />
    <?php    
    echo CHtml::link(
            "Verwijderen",
            "#",
            array("submit"=>array(
                "noodEnvelop/delete",
                'nood_envelop_id'=>$data->nood_envelop_ID,
                'event_id'=>$data->event_ID,
                'route_id'=>$data->route_ID),
            "confirm"=>"Weet je zeker dat je deze hint wilt verwijderen?")) 

    ?><br /><?php
    if (NoodEnvelop::model()->isActionAllowed(
										"noodEnvelop", 
										"moveUpDown", 
                                        $data->event_ID,
										$data->nood_envelop_ID,
                                        "",
                                        $data->nood_envelop_volgorde, 
										"up")) {
        echo CHtml::link(
            "Omhoog",
            "#",
            array(
                "submit"=>array(
                    "noodEnvelop/moveUpDown",
                    'event_id'=>$data->event_ID,
                    'nood_envelop_id'=>$data->nood_envelop_ID,
                    'volgorde'=>$data->nood_envelop_volgorde,
                    'up_down'=>"up"), 
                "confirm"=>"Weet je zeker dat je deze hint omhoog wilt schuiven?"));
        ?><br /><?php
    }

    if (NoodEnvelop::model()->isActionAllowed(
										"noodEnvelop", 
										"moveUpDown", 
                                        $data->event_ID,
										$data->nood_envelop_ID,
                                        "",
                                        $data->nood_envelop_volgorde, 
										"down"))
	{
        echo CHtml::link(
            "Omlaag",
            "#",
            array(
                "submit"=>array(
                    "noodEnvelop/moveUpDown",
                    'event_id'=>$data->event_ID,
                    'nood_envelop_id'=>$data->nood_envelop_ID,
                    'volgorde'=>$data->nood_envelop_volgorde,
					'up_down'=>"down"),
                "confirm"=>"Weet je zeker dat je deze hint omlaag wilt schuiven?"));
    }?>

</div>