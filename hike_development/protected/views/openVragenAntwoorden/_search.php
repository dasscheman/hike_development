<?php
/* @var $this OpenVragenAntwoordenController */
/* @var $model OpenVragenAntwoorden */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'open_vragen_antwoorden_ID'); ?>
		<?php echo $form->textField($model,'open_vragen_antwoorden_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'open_vragen_ID'); ?>
		<?php echo $form->textField($model,'open_vragen_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'group_ID'); ?>
		<?php echo $form->textField($model,'group_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vraag'); ?>
		<?php echo $form->textField($model,'vraag',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'antwoord_spelers'); ?>
		<?php echo $form->textField($model,'antwoord_spelers',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'checked'); ?>
		<?php echo $form->textField($model,'checked'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'correct'); ?>
		<?php echo $form->textField($model,'correct'); ?>
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