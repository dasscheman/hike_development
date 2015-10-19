<?php
/* @var $this OpenNoodEnvelopController */
/* @var $model OpenNoodEnvelop */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'open-nood-envelop-form',
	'enableAjaxValidation'=>false,
)); ?>

	<h3>Groep: <?php echo Groups::model()->getGroupName($model->group_ID); ?></h3>
	<h3>Hint: <?php echo NoodEnvelop::model()->getNoodEnvelopName($model->nood_envelop_ID); ?></h3>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="row compactRadioGroup">
			<?php echo $form->radioButtonList($model,'opened', 
					array(  0 => 'Gesloten',
							1 => 'Geopend'), 
					array( 'separator' => " " ) ); ?>
		</div>
		<?php echo $form->error($model,'opened'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->