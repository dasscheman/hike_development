<?php
/* @var $this OpenVragenAntwoordenController */
/* @var $model OpenVragenAntwoorden */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'open-vragen-antwoorden-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php //echo $form->labelEx($model,'open_vragen_ID'); ?>
		<?php echo $form->hiddenField($model,
                                    'open_vragen_ID', 
                                     array('value'=>$_GET['vraag_id'])
                                     );
		      //echo OpenVragen::model()->getOpenVragenName($_GET['vraag_id']);?>				     
		<?php echo $form->error($model,'open_vragen_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model, 'event_ID', 
                                     array(
                                        'value'=>$_GET['event_id'], 
                                        'readonly' => 'true'))
                                     ;?>
		<?php echo $form->error($model,'event_ID'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->hiddenField($model, 'group_ID', 
                                     array(
                                        'value'=>$_GET['group_id'], 
                                        'readonly' => 'true'))
                                     ;?>
		<?php echo $form->error($model,'group_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vraag'); ?>
		<?php echo $form->hiddenField($model,
					      'vraag',
					      array('value'=>OpenVragen::model()->getOpenVraag($_GET['vraag_id']),
						    'readonly' => true));
		      echo OpenVragen::model()->getOpenVraag($_GET['vraag_id']);?>		
		<?php echo $form->error($model,'vraag'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'antwoord_spelers'); ?>
		<?php echo $form->textField($model,'antwoord_spelers',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'antwoord_spelers'); ?>
	</div>
<!--
	<div class="row">
		<?php /*echo $form->labelEx($model,'checked'); ?>
		<?php echo $form->textField($model,'checked'); ?>
		<?php echo $form->error($model,'checked'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'correct'); ?>
		<?php echo $form->textField($model,'correct'); ?>
		<?php echo $form->error($model,'correct'); */?>
	</div>
-->
	<div class="row">
		<?php echo $form->labelEx($model,'score'); ?>
		<?php echo $form->hiddenField($model,
					      'score',
					      array('value'=>OpenVragen::model()->getOpenVraagScore($_GET['vraag_id']),
						    'readonly' => true));
		      echo OpenVragen::model()->getOpenVraagScore($_GET['vraag_id']);?>	
		<?php echo $form->error($model,'score'); ?>
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