<?php
/* @var $this BonuspuntenController */
/* @var $model Bonuspunten */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'bouspunten_ID'); ?>
		<?php echo $form->textField($model,'bouspunten_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'event_ID'); ?>
		<?php echo $form->textField($model,'event_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'day_ID'); ?>
		<?php echo $form->textField($model,'day_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_ID'); ?>
		<?php echo $form->textField($model,'post_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'group_ID'); ?>
		<?php echo $form->textField($model,'group_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'omschrijving'); ?>
		<?php echo $form->textField($model,'omschrijving',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'score'); ?>
		<?php echo $form->textField($model,'score'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_time'); ?>
		<?php echo $form->textField($model,'create_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_user_ID'); ?>
		<?php echo $form->textField($model,'create_user_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'update_time'); ?>
		<?php echo $form->textField($model,'update_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'update_user_ID'); ?>
		<?php echo $form->textField($model,'update_user_ID'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->