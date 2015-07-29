<?php
/* @var $this EventNamesController */
/* @var $model EventNames */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'event-names-form',
	'enableAjaxValidation'=>false,
)); ?>
<h3>
	De active dag geeft aan welke onderdelen de deelnemers kunnen zien. Bijvoorbeeld: als je van dag 1 naar dag 2 gaat, dan kunnen de 
	deelnemers de vragen die bij dag 1 horen niet meer zien. 
	</h3>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'event_name'); ?>
		<?php echo $form->textField($model,
					    'event_name',
					    array('size'=>60,
						  'maxlength'=>255,
						  'readonly'=>true)); ?>
		<?php echo $form->error($model,'event_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start_date'); ?>
		<?php echo $form->textField($model,
					    'start_date',
					    array('readonly'=>true)); ?>
		<?php echo $form->error($model,'start_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'end_date'); ?>
		<?php echo $form->textField($model,
					    'end_date',
					    array('readonly'=>true)); ?>
		<?php echo $form->error($model,'end_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo CHtml::encode(EventNames::model()->getStatusText2($model->status)) ?>
		<?php /*echo $form->textField($model,
					    'status',
					    array('readonly'=>true));*/ ?>           
		<?php echo $form->error($model,'status'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'active_day'); ?>
		<?php //echo $form->textField($model,'start_date'); 
              $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $model,
                'attribute' => 'active_day',
                'options' => array(
                    'showOn' => 'both',             // also opens with a button
                    'dateFormat' => 'yy-mm-dd',     // format of "2012-12-25"  
					'minDate' => $model->start_date,
					'maxDate' => $model->end_date,
				),
                'htmlOptions' => array(
					'id' => 'active_day',
                    'size' => '10',         // textField size
                    'maxlength' => '10',    // textField maxlength
                    ),
               ));?>
		<?php //echo $form->dropDownList($model,'active_day', EventNames::model()->getDatesAvailable($_GET['event_id']));?>
		<?php echo $form->error($model,'active_day'); ?>
	</div>
	<p>
		Geef hier het aantal hele uren dat de deelnemers deze dag mogen lopen.
		LET OP! Tijd moet je zo definieren: HH:MM:SS
	</p>
	<div class="row">
		<?php echo $form->labelEx($model,'max_time'); ?>
		<?php echo $form->textField($model,'max_time');?>
		<?php echo $form->error($model,'max_time'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'create_user_ID'); ?>
		<?php //echo $form->textField($model,'create_user_ID'); ?>
		<?php //echo $form->error($model,'create_user_ID'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'update_time'); ?>
		<?php //echo $form->textField($model,'update_time'); ?>
		<?php //echo $form->error($model,'update_time'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'update_user_ID'); ?>
		<?php //echo $form->textField($model,'update_user_ID'); ?>
		<?php //echo $form->error($model,'update_user_ID'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->