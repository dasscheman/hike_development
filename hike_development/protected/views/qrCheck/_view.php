<?php
// Created: 2014
// Modified: 26 jan 2015

/* @var $this QrCheckController */
/* @var $data QrCheck */
?>

<div class="view">
<?php
    if(QrCheck::model()->isActionAllowed('qrCheck', 'update', $data->event_ID)) {
        echo CHtml::link('<span class="fa-stack fa-lg">
                                <i class="fa fa-pencil fa-stack-1x"></i>
                                <i class="fa fa-blue fa-text-right fa-07x"> Wijzigen </i>
                          </span>',
                          array('qrCheck/update',
                                'id'=>$data->qr_check_ID,
                                'event_id'=>$data->event_ID,
                                'group_id'=>$data->group_ID)); 
    }  ?> <br/>
	<b><?php echo CHtml::encode($data->getAttributeLabel('qr_ID')); ?>:</b>
	<?php echo CHtml::encode(Qr::model()->getQrCode($data->event_ID, $data->qr_ID)); ?>
	<br />
	<b><?php echo CHtml::encode('Stille Post Naam'); ?>:</b>
	<?php echo CHtml::encode(Qr::model()->getQrCodeName($data->event_ID, $data->qr_ID)); ?>
	<br />

	<b><?php echo CHtml::encode('Score'); ?>:</b>
	<?php echo CHtml::encode(Qr::model()->getQrScore($data->qr_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_user_ID')); ?>:</b>
	<?php echo CHtml::encode(Users::model()->getUserName($data->create_user_ID)); ?>
	<br />
</div>