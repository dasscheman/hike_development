<?php
/* @var $this RouteController */
/* @var $model Route */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'route-form',
	'enableAjaxValidation'=>false,
)); ?>

	
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'route_name'); ?>
		<?php echo $form->textField($model,'route_name'); ?>
		<?php echo $form->error($model,'route_name'); ?>
	</div>
<!-- Voorlopig kan datum niet aangepast worden. Dit zorgd voor problemen bij de update.
De default datum wordt niet goed gezet in de dropdown menu. Misschien beter met een kalender oplossen.
	<div class="row">
		<?php /*echo $form->labelEx($model,'day_date'); ?>
		<?php echo $form->dropDownList($model,
									   'day_date', 
									   EventNames::model()->getDatesAvailable($_GET['event_id']));?>
		<?php echo $form->error($model,'day_date');*/ ?>
	</div>
	-->
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->