<?php
// Created: 2014
// Modified: 4 jan 2015

/* @var $this OpenVragenController */
/* @var $model OpenVragen */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'open-vragen-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
    <table>
        <td style="text-align:right;">
            <div class="row">
                <?php echo $form->labelEx($model,'open_vragen_name'); ?>
                <?php echo $form->textField($model,'open_vragen_name',array('size'=>60,'maxlength'=>255)); ?>
                <?php echo $form->error($model,'open_vragen_name'); ?>
            </div>
        
            <div class="row">
                <?php echo $form->labelEx($model,'omschrijving'); ?>
                <?php echo $form->textField($model,'omschrijving',array('size'=>60,'maxlength'=>255)); ?>
                <?php echo $form->error($model,'omschrijving'); ?>
            </div>
            
            <div class="row">
                <?php echo $form->labelEx($model,'vraag'); ?>
                <?php echo $form->textField($model,'vraag',array('size'=>60,'maxlength'=>255)); ?>
                <?php echo $form->error($model,'vraag'); ?>
            </div>
        </td>
        <td>
            <div class="row">
                <?php echo $form->labelEx($model,'goede_antwoord'); ?>
                <?php echo $form->textField($model,'goede_antwoord',array('size'=>60,'maxlength'=>255)); ?>
                <?php echo $form->error($model,'goede_antwoord'); ?>
            </div>
            
            <div class="row">
                <?php echo $form->labelEx($model,'score'); ?>
                <?php echo $form->textField($model,'score'); ?>
                <?php echo $form->error($model,'score'); ?>
            </div>
        
            <div class="row buttons">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
            </div>
        </td>
    </table>
<?php $this->endWidget(); ?>

</div><!-- form -->