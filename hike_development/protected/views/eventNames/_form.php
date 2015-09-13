<?php
// Created: 2014
// Modified: 22 feb 2015

/* @var $this EventNamesController */
/* @var $model EventNames */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'event-names-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>
	<?php
	if (Yii::app()->controller->action->id == "update" ||
		$model->isNewRecord){ ?>
		<h4> Geef de hike een naam en vul de begin en eind datum in. Een hike mag niet langer duren dan 10 dagen!</h4>
		<p class="note">Fields with <span class="required">*</span> are required.</p>

		<?php echo $form->errorSummary($model); ?>

		<div class="row">
			<?php echo $form->labelEx($model,'event_name'); ?>
			<?php echo $form->textField($model,'event_name',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'event_name'); ?>
		</div>
	
		<div class="row">
			<?php echo $form->labelEx($model,'start_date'); ?>
			<?php //echo $form->textField($model,'start_date'); 
				  $this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'model' => $model,
					'attribute' => 'start_date',
					'options' => array(
						'showOn' => 'both',             // also opens with a button
						'dateFormat' => 'yy-mm-dd',     // format of "2012-12-25"  
						'minDate' => '1d',
						'onSelect' => new CJavaScriptExpression('function (selectedDate) { 
							var d = new Date(selectedDate);
							d.setDate(d.getDate() + 10);
							$("#end_date").datepicker("option", "minDate", selectedDate); 
							$("#end_date").datepicker("option", "maxDate", d); }'),				
					),
					'htmlOptions' => array(
						'id' => 'start_date',
						'size' => '10',         // textField size
						'maxlength' => '10',    // textField maxlength
						),
				   ));?>
			<?php echo $form->error($model,'start_date'); ?>
		</div>
	
		<div class="row">
			<?php echo $form->labelEx($model,'end_date'); ?>
			<?php //echo $form->textField($model,'end_date'); 
				  $this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'model' => $model,
					'attribute' => 'end_date',
					'options' => array(
						'showOn' => 'both',             // also opens with a button
						'dateFormat' => 'yy-mm-dd',     // format of "2012-12-25" 
						'minDate' => '1d',
						'onSelect' => new CJavaScriptExpression('function (selectedDate) {
							$("#start_date").datepicker("option", "maxDate", selectedDate); }'),	
							// min datum wordt niet beperkt. Hierdoor kan je er voor zorgen dat 
							// max lengte van 10 dagen wel overschreden wordt. Maar het zorgt er ook
							// voor dat het niet heel lastig corrigeren is als de datem helemaal 
							// verkeerd gekozen is.
							// var d = new Date(selectedDate);
							// d.setDate(d.getDate() - 10);
							// $("#start_date").datepicker("option", "minDate", d); }'),		
						),
					'htmlOptions' => array(
						'id' => 'end_date',
						'size' => '10',         // textField size
						'maxlength' => '10',    // textField maxlength
						),
				   ));?>
			<?php echo $form->error($model,'end_date'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model, 'organisatie'); ?>
			<?php echo $form->textField($model, 'organisatie'); ?>
			<?php echo $form->error($model, 'organisatie'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model, 'website'); ?>
			<?php echo $form->textField($model, 'website'); ?>
			<?php echo $form->error($model, 'website'); ?>
		</div>

	<?php
	}

	if(!$model->isNewRecord && isset($model->image) && file_exists('images/event_images/' . $model->image)) {
		echo CHtml::image('images/event_images/' . $model->image, "Logo van organisatie",
				array("width"=>"40%" ,"height"=>"40%"));
	}
	?>

	<?php
	if (Yii::app()->controller->action->id == "updateImage" ||
		$model->isNewRecord){ ?>
		<h4> Je kunt hier een plaatje selecteren. Deze wordt oa gebruikt voor de stille posten.</h4>

		<div class="row">
			<?php echo $form->labelEx($model, 'image'); ?>
			<?php echo $form->fileField($model, 'image'); ?>
			<?php echo $form->error($model, 'image'); ?>
		</div>
	<?php } ?>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->