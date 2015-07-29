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
		<?php echo $form->labelEx($model,'date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $model,
                'attribute' => 'date',
                'options' => array(
                    'showOn' => 'both',             // also opens with a button
                    'dateFormat' => 'yy-mm-dd',     // format of "2012-12-25"
					'minDate'=>EventNames::model()->getStartDate($_GET['event_id']),
					'maxDate'=>EventNames::model()->getEndDate($_GET['event_id']),
                    ),
                'htmlOptions' => array(
                    'size' => '10',         // textField size
                    'maxlength' => '10',    // textField maxlength
                    ),
               ));?>
		<?php echo $form->error($model,'date'); ?>
	</div>
	<div class="row">
		<?php //echo $form->labelEx($model,'date'); ?>
		<?php //echo $form->dropDownList($model,'date',
              //  EventNames::model()->getDatesAvailable($_GET['event_id']));?>
		<?php //echo $form->error($model,'date'); ?>
	</div>

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