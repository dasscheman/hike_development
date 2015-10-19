<?php
/* @var $this OpenVragenAntwoordenController */
/* @var $model OpenVragenAntwoorden */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'open-vragen-antwoorden-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'vraag'); ?>
		<?php echo OpenVragen::model()->getOpenVraag($model->open_vragen_ID); ?>
		<?php echo $form->error($model,'vraag'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'antwoord_spelers'); ?>
		<?php echo $form->textField($model,'antwoord_spelers',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'antwoord_spelers'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'checked'); ?>
		<?php echo $form->checkBox($model,'checked'); ?>
		<?php echo $form->error($model,'checked'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'correct'); ?>
		<?php echo $form->checkBox($model,'correct'); ?>
		<?php echo $form->error($model,'correct'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'score'); ?>
		<?php echo OpenVragen::model()->getOpenVraagScore($model->open_vragen_ID); ?>
		<?php echo $form->error($model,'score'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->