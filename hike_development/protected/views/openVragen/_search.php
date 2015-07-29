<?php
/* @var $this OpenVragenController */
/* @var $model OpenVragen */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'open_vragen_ID'); ?>
		<?php echo $form->textField($model,'open_vragen_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'open_vragen_name'); ?>
		<?php echo $form->textField($model,'open_vragen_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'event_ID'); ?>
		<?php echo $form->textField($model,'event_ID'); ?>
	</div>


	<div class="row">
		<?php echo $form->label($model,'route_techniek_ID'); ?>
		<?php echo $form->textField($model,'route_techniek_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'day_ID'); ?>
		<?php echo $form->textField($model,'day_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vraag_volgorde'); ?>
		<?php echo $form->textField($model,'vraag_volgorde'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'vraag'); ?>
		<?php echo $form->textField($model,'vraag',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'goede_antwoord'); ?>
		<?php echo $form->textField($model,'goede_antwoord',array('size'=>60,'maxlength'=>255)); ?>
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