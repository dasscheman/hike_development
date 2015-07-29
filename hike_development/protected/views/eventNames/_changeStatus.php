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
	Verander de status van de hike. Als je klaar bent met uitzetten, dan kun je de status op introductie of gestart zetten. 
	Vanaf dat moment kunnen de deelnemers onderdelen zien.
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
		<?php //echo $form->textField($model,'status');
			echo $form->dropDownList(
                                        $model, 
                                        'status', 
                                        EventNames::model()->getStatusOptions(),
                                        array('ajax' => array(
                                                        'url' => CController::createUrl('dynamicDays'),
                                                        'type' => 'POST',                     
                                                        'update'=>'#EventNames_active_day',
                                                        'data'=>array('status'=>'js:this.value',
								      'event_id'=>$_GET['event_id'])),
                                              'empty' => '--Selecteer een Status--', 'style'=>'width:220px;')); 
            
		      //echo $form->dropDownList($model,'status', $model->getStatusOptions());?>
		<?php echo $form->error($model,'status'); ?>
	</div>
<!--
	<div class="row">
		<?php /*echo $form->labelEx($model,'active_day'); ?>
		<?php //echo $form->textField($model,'active_day');
		      echo CHtml::dropDownList('EventNames[active_day]',
					       "",
					       array(),
					       array('prompt'=> '--Selecteer eerst een dag--',
						     'style'=>'width:220px;'));?>
		<?php echo $form->error($model,'active_day'); */?>
	</div>
-->	
	<div class="row">
		<?php //echo $form->labelEx($model,'create_time'); ?>
		<?php //echo $form->textField($model,'create_time'); ?>
		<?php //echo $form->error($model,'create_time'); ?>
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