<?php
// Created: 2014
// Modified: 23 feb 2015

/* @var $this OpenVragenController */
/* @var $data OpenVragen */
?>

<div class="view">
    <table>

        <td style="text-align:right;" width="50%">
            <b><?php echo CHtml::encode($data->getAttributeLabel('open_vragen_name')); ?>:</b>
            <?php 	if (OpenVragen::model()->isActionAllowed('openVragen', 'update', $data->event_ID)) {
						echo CHtml::link(CHtml::encode($data->open_vragen_name),
											   array('/openVragen/update',
												 'id'=>$data->open_vragen_ID,
												 'event_id'=>$data->event_ID));
					} else {
						echo CHtml::encode($data->open_vragen_name);
					}?>
            <br />

            <b><?php echo CHtml::encode($data->getAttributeLabel('route_ID')); ?>:</b>
            <?php echo CHtml::encode(Route::model()->getRouteName($data->route_ID)); ?>
            <br />

            <b><?php echo CHtml::encode($data->getAttributeLabel('omschrijving')); ?>:</b>
            <?php echo CHtml::encode($data->omschrijving); ?>
            <br />

            <b><?php echo CHtml::encode($data->getAttributeLabel('vraag')); ?>:</b>
            <?php echo CHtml::encode($data->vraag); ?>
            <br />

        </td>
        <td>
            <b><?php echo CHtml::encode($data->getAttributeLabel('goede_antwoord')); ?>:</b>
            <?php echo CHtml::encode($data->goede_antwoord); ?>
            <br />

            <b><?php echo CHtml::encode($data->getAttributeLabel('score')); ?>:</b>
            <?php echo CHtml::encode($data->score); ?>
            <br />

            <b><?php echo CHtml::encode($data->getAttributeLabel('vraag_volgorde')); ?>:</b>
            <?php echo CHtml::encode($data->vraag_volgorde); ?>
            <br />

            <?php

            if (OpenVragen::model()->isActionAllowed('openVragen', 'delete', $data->event_ID, $data->open_vragen_ID)){
                echo CHtml::link(
                    "Verwijderen",
                    "#",
                    array("submit"=>array(
                        "openVragen/delete",
                        'vraag_id'=>$data->open_vragen_ID,
                        'event_id'=>$data->event_ID,
                        'route_id'=>$data->route_ID),
                    "confirm"=>"Weet je zeker dat je deze vraag wilt verwijderen?"));
                ?><br /><?php
            }

            if (OpenVragen::model()->isActionAllowed(
										"openVragen",
										"moveUpDown",
                                        $data->event_ID,
										$data->open_vragen_ID,
                                        "", //grou_id
										"", //date
                                        $data->vraag_volgorde,
										"up")) {
				echo CHtml::link(
                    "Omhoog",
                    "#",
                    array(
                        "submit"=>array(
                            "openVragen/moveUpDown",
                            'event_id'=>$data->event_ID,
							'vraag_id'=>$data->open_vragen_ID,
                            'volgorde'=>$data->vraag_volgorde,
                            'up_down'=>"up"),
                        "confirm"=>"Weet je zeker dat je deze vraag omhoog wilt schuiven?"));
                ?><br /><?php
            }

            if (OpenVragen::model()->isActionAllowed(
										"openVragen",
										"moveUpDown",
                                        $data->event_ID,
										$data->open_vragen_ID,
                                        "", //group_id
										"", //date
                                        $data->vraag_volgorde,
										"down")) {
				echo CHtml::link(
                    "Omlaag",
                    "#",
                    array(
                        "submit"=>array(
                            "openVragen/moveUpDown",
							'vraag_id'=>$data->open_vragen_ID,
                            'event_id'=>$data->event_ID,
							'vraag_id'=>$data->open_vragen_ID,
                            'volgorde'=>$data->vraag_volgorde,
                            'up_down'=>"down"),
                        "confirm"=>"Weet je zeker dat je deze vraag omlaag wilt schuiven?"));
            }?>
        </td>
    </table>
</div>