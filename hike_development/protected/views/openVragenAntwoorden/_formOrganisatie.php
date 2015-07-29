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
<!--
	<div class="row">
		<?php /*echo $form->labelEx($model,'open_vragen_ID'); ?>
		<?php echo $form->textField($model,'open_vragen_ID'); ?>
		<?php echo $form->error($model,'open_vragen_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'event_ID'); ?>
		<?php echo $form->textField($model,'event_ID'); ?>
		<?php echo $form->error($model,'event_ID'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'group_ID'); ?>
		<?php echo $form->textField($model,'group_ID'); ?>
		<?php echo $form->error($model,'group_ID'); */?>
	</div>
-->
	<div class="row">
		<?php echo $form->labelEx($model,'vraag'); ?>
		<?php echo $model->vraag; ?>
		<?php echo $form->error($model,'vraag'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'antwoord_spelers'); ?>
		<?php echo $form->textField($model,'antwoord_spelers',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'antwoord_spelers'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'checked'); ?>
		<?php echo $form->textField($model,'checked'); ?>
		<?php echo $form->error($model,'checked'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'correct'); ?>
		<?php echo $form->textField($model,'correct'); ?>
		<?php echo $form->error($model,'correct'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'score'); ?>
		<?php echo $form->textField($model,'score');?>
		<?php echo $form->error($model,'score'); ?>
	</div>
<!--
	<div class="row">
		<?php /*echo $form->labelEx($model,'create_time'); ?>
		<?php echo $form->textField($model,'create_time'); ?>
		<?php echo $form->error($model,'create_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_user_ID'); ?>
		<?php echo $form->textField($model,'create_user_ID'); ?>
		<?php echo $form->error($model,'create_user_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'update_time'); ?>
		<?php echo $form->textField($model,'update_time'); ?>
		<?php echo $form->error($model,'update_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'update_user_ID'); ?>
		<?php echo $form->textField($model,'update_user_ID'); ?>
		<?php echo $form->error($model,'update_user_ID'); */?>
	</div>
-->
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->