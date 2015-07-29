<?php
// Created: 2014
// Modified: 25 jan 2015

/* @var $this BonuspuntenController */
/* @var $model Bonuspunten */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bonuspunten-form',
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
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->dropDownList($model,
				              'date',
					      EventNames::model()->getDatesAvailable($_GET['event_id']),
					      array('ajax' => array('url' => CController::createUrl('dynamicPostId'),
								    'type' => 'POST',
								    'update'=>'#Bonuspunten_post_ID',
								    'data'=>array('date'=>'js:this.value',
										  'event_id'=>$_GET['event_id'])),
                                              'empty' => '--Selecteer een Dag--', 'style'=>'width:150px;'));?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'post_ID'); ?>
		<?php echo CHtml::dropDownList('Bonuspunten[post_ID]',
					       "", 
					       array(),
					       array('prompt'=> '--Selecteer eerst een dag--',
						     'style'=>'width:200px;'));?>
		<?php echo $form->error($model,'post_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'group_ID'); ?>
		<?php echo $form->dropDownList($model,
					       'group_ID',
					       Groups::model()->getGroupOptionsForEvent($_GET['event_id']));?>
		<?php echo $form->error($model,'group_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'omschrijving'); ?>
		<?php echo $form->textField($model,'omschrijving',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'omschrijving'); ?>
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