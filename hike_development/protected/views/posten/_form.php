<?php
/* @var $this PostenController */
/* @var $model Posten */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'posten-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'post_name'); ?>
		<?php echo $form->textField($model,'post_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'post_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'day_ID'); ?>
		<?php //echo $form->textField($model,'day_ID'); 
                      echo $form->dropDownList($model,
					       'day_ID',
					       EventNames::model()->getDatesAvailable($_GET['event_id']));?>
		<?php echo $form->error($model,'day_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'post_volgorde'); ?>
		<?php echo $form->textField($model,'post_volgorde'); ?>
		<?php echo $form->error($model,'post_volgorde'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'score'); ?>
		<?php echo $form->textField($model,'score'); ?>
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