<?php
/* @var $this GroupsController */
/* @var $model Groups */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'groups-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php echo $form->hiddenField($model, 'event_ID', 
                                     array(
                                        'value'=>$_GET['event_id'], 
                                        'readonly' => 'true'))
                                     ;?>
		<?php echo $form->error($model,'event_ID'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'group_name'); ?>
		<?php echo $form->textField($model,'group_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'group_name'); ?>
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