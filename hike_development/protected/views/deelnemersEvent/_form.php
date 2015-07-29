<?php
/* @var $this DeelnemersEventController */
/* @var $model DeelnemersEvent */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'deelnemers-event-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
<!--
	<div class="row">
		<?php /*echo $form->labelEx($model,'user_ID'); ?>
		<?php //echo $form->textField($model,'user_ID');
			echo $form->dropDownList($model,'user_ID', Users::model()->getUserNameOptions());?>
		<?php echo $form->error($model,'user_ID'); */?>
	</div>
-->
	<div class="row">
		<?php echo $form->labelEx($model,'rol'); ?>
		<?php echo $form->dropDownList($model, 
						'rol', 
						DeelnemersEvent::model()->getRolOptions(),
						array('ajax' => array(
								'url' => CController::createUrl('dynamicRol'),
								'type' => 'POST',                     
								'update'=>'#DeelnemersEvent_group_ID',
								'data'=>array('rol'=>'js:this.value',
									      'event_id'=>$_GET['event_id'])),
						      'empty' => '--Selecteer een Rol--',
						      'style'=>'width:150px;'));?>
		<?php echo $form->error($model,'rol'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'group_ID'); ?>
		<?php echo CHtml::dropDownList('DeelnemersEvent[group_ID]',
						"",
						array(),
						array('prompt'=> '--Selecteer eerst een rol--',
						      'style'=>'width:200px;'));?>
		<?php echo $form->error($model,'group_ID'); ?>
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