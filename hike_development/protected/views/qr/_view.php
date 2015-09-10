<?php
// Created: 2014
// Modified: 23 feb 2015

/* @var $this QrController */
/* @var $data Qr */
?>
<?php
	$eventid = $data->event_ID;
	$qr_code = $data->qr_code;
	$link = "http://www.hike-app.nl/index.php?r=qrCheck/create%26event_id=".$eventid."%26qr_code=".$qr_code;
?>

<div class="view">
    <table>
        <td style="text-align:right;" width="50%">
            <?php echo CHtml::link('PDF fomulier genereren', array('qr/report', 'event_id'=>$data->event_ID,
                                             'id'=>$data->qr_ID)); ?>
            <br />

            <b><?php echo CHtml::encode($data->getAttributeLabel('route_ID')); ?>:</b>
            <?php echo CHtml::encode(Route::model()->getRouteName($data->route_ID)); ?>
            <br />

            <b><?php echo CHtml::encode('Dag'); ?>:</b>
            <?php echo CHtml::encode(Route::model()->getDayOfRouteId($data->route_ID)); ?>
            <br />

            <b><?php echo CHtml::encode($data->getAttributeLabel('qr_name')); ?>:</b>
            <?php 	if (Qr::model()->isActionAllowed('qr', 'update', $data->event_ID)) {
						echo CHtml::link(CHtml::encode($data->qr_name),
										 array('/qr/update',
											   'qr_id'=>$data->qr_ID,
											   'event_id'=>$data->event_ID));

					} else {
						echo CHtml::encode($data->qr_name);
					}
			?>
            <br />

            <b><?php echo CHtml::encode($data->getAttributeLabel('qr_code')); ?>:</b>
            <?php echo CHtml::encode($data->qr_code); ?>
            <br />

            <b><?php echo CHtml::encode($data->getAttributeLabel('score')); ?>:</b>
            <?php echo CHtml::encode($data->score); ?>
            <br />
        </td>
        <td>
            <img src="http://www.mobile-barcodes.com/qr-code-generator/generator.php?str=
            <?php echo $link ?>
            &barcode=url"
            alt="QR Code" style="border:none;" />
        </td>
        <?php
            if (Qr::model()->isActionAllowed('qr', 'delete', $data->event_ID, $data->qr_ID)){
                echo CHtml::link(
                    "Verwijderen",
                    "#",
                    array("submit"=>array(
                        "qr/delete",
                        'qr_id'=>$data->qr_ID,
                        'event_id'=>$data->event_ID,
                        'route_id'=>$data->route_ID),
                    "confirm"=>"Weet je zeker dat je deze stillen post wilt verwijderen?"));
            }
            ?><br /><?php
            if (Qr::model()->isActionAllowed(
										"qr",
										"moveUpDown",
                                        $data->event_ID,
										$data->qr_ID,
                                        "", //group_id
										"", //date
                                        $data->qr_volgorde,
										"up")) {
                echo CHtml::link(
                    "Omhoog",
                    "#",
                    array(
                        "submit"=>array(
                            "qr/moveUpDown",
                            'event_id'=>$data->event_ID,
                            'qr_id'=>$data->qr_ID,
                            'volgorde'=>$data->qr_volgorde,
                            'up_down'=>"up"),
                        "confirm"=>"Weet je zeker dat je deze stille post omhoog wilt schuiven?"));
                ?><br /><?php
            }

            if (Qr::model()->isActionAllowed(
										"qr",
										"moveUpDown",
                                        $data->event_ID,
										$data->qr_ID,
                                        "", //grou_id
										"", //date
                                        $data->qr_volgorde,
										"down")) {
                echo CHtml::link(
                    "Omlaag",
                    "#",
                    array(
                        "submit"=>array(
                            "qr/moveUpDown",
                            'event_id'=>$data->event_ID,
                            'qr_id'=>$data->qr_ID,
                            'volgorde'=>$data->qr_volgorde,
                            'up_down'=>"down"),
                        "confirm"=>"Weet je zeker dat je deze stille post omlaag wilt schuiven?"));
            }?>

    </table>
</div>