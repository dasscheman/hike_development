<?php
// Created: 2014
// Modified: 10 jan 2015

/* @var $this NoodEnvelopController */
/* @var $model NoodEnvelop */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'nood-envelop-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nood_envelop_name'); ?>
		<?php echo $form->textField($model,'nood_envelop_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nood_envelop_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'coordinaat'); ?>
		<?php echo $form->textField($model,'coordinaat',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'coordinaat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'opmerkingen'); ?>
		<?php echo $form->textField($model,'opmerkingen',array('size'=>60,'maxlength'=>1050)); ?>
		<?php echo $form->error($model,'opmerkingen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'score'); ?>
		<?php echo $form->textField($model,'score'); ?>
		<?php echo $form->error($model,'score'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->