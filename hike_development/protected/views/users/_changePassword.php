<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
<!--
	<div class="row">
		<?php /*echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'voornaam'); ?>
		<?php echo $form->textField($model,'voornaam',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'voornaam'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'achternaam'); ?>
		<?php echo $form->textField($model,'achternaam',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'achternaam'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); */?>
	</div>
-->
	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',
                                                array('size'=>60,
                                                      'maxlength'=>255,
                                                      'value'=>'')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

        <div class="row">
                <?php echo $form->labelEx($model,'password_repeat'); ?>
                <?php echo $form->passwordField($model,'password_repeat',array('size'=>60,'maxlength'=>255)); ?>
                <?php echo $form->error($model,'password_repeat'); ?>
        </div>
<!--
	<div class="row">
		<?php //echo $form->labelEx($model,'macadres'); ?>
		<?php //echo $form->textField($model,'macadres',array('size'=>60,'maxlength'=>255)); ?>
		<?php //echo $form->error($model,'macadres'); ?>
	</div>

	<div class="row">
		<?php /*echo $form->labelEx($model,'birthdate'); ?>
		<?php //echo $form->textField($model,'birthdate'); 
              $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $model,
                'attribute' => 'birthdate',
                'options' => array(
                    'showOn' => 'both',             // also opens with a button
                    'dateFormat' => 'yy-mm-dd',     // format of "2012-12-25"  
                    ),
                'htmlOptions' => array(
                    'size' => '10',         // textField size
                    'maxlength' => '10',    // textField maxlength
                    ),
               ));?>
		<?php echo $form->error($model,'birthdate'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'last_login_time'); ?>
		<?php //echo $form->textField($model,'last_login_time'); ?>
		<?php //echo $form->error($model,'last_login_time'); ?>
	</div>

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
		<?php //echo $form->error($model,'update_user_ID'); */?>
	</div>
-->
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->