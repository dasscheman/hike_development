<?php
/* @var $this OpenNoodEnvelopController */
/* @var $model OpenNoodEnvelop */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'open-nood-envelop-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
<!--
	<div class="row">
		<?php //echo $form->labelEx($model,'event_ID'); ?>
		<?php //echo $form->textField($model,'event_ID'); ?>
		<?php //echo $form->error($model,'event_ID'); ?>
	</div>
->
	<div class="row">
		<?php echo $form->labelEx($model,'nood_envelop_ID'); ?>
		<?php echo $form->textField($model,'nood_envelop_ID'); ?>
		<?php echo $form->error($model,'nood_envelop_ID'); ?>
	</div>
<!--
	<div class="row">
		<?php //echo $form->labelEx($model,'group_ID'); ?>
		<?php //echo $form->textField($model,'group_ID'); ?>
		<?php //echo $form->error($model,'group_ID'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'opened'); ?>
		<?php //echo $form->textField($model,'opened'); ?>
		<?php //echo $form->error($model,'opened'); ?>
	</div>
-->
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