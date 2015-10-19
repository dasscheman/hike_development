<?php
/* @var $this PostPassageController */
/* @var $model PostPassage */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'post-passage-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'post_ID'); ?>
		<?php echo $form->dropDownList($model,
				'post_ID', 
				 Posten::model()->getPostNameOptions($model->event_ID));?>
		<?php echo $form->error($model,'post_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'group_ID'); ?>
		<?php echo $form->dropDownList($model,
				'group_ID',
				Groups::model()->getGroupOptionsForEvent($model->event_ID));?>
		<?php echo $form->error($model,'group_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gepasseerd'); ?>
		<div class="row compactRadioGroup">
			<?php echo $form->radioButtonList($model,'gepasseerd', 
					array(  0 => 'Nee',
							1 => 'Ja'), 
					array( 'separator' => " " ) ); ?>
		</div>
		<?php echo $form->error($model,'gepasseerd'); ?>
	</div>
	<?php
	// In the case of a start post, the binnenkomst is not set. And we dont want users to change this. 
	if ($model->binnenkomst != '0000-00-00 00:00:00' && $model->binnenkomst != null) { ?>
		<div class="row">
			<?php echo $form->labelEx($model,'binnenkomst'); ?>
			<?php $this->widget('application.extensions.timepicker.timepicker',
						array('model'=>$model,
						  'name'=>'binnenkomst',
						  'options'=>array(
								   'showAnim'=>'slide',
								   'showSecond'=>false,
								   'ampm'=>false,
								   'value'=>date("Y-m-d H:i", $model->binnenkomst), 
								   'dateFormat'=>'yy-mm-dd',
								   'changeMonth' => false,
								   'changeYear' => false,
								   'showOn'=>'focus',
								   'timeFormat'=>'hh:mm',
								   'showPeriodLabels' => false,
								   'showNowButton'=>true,
								   ),
						  )
						);?>
			<?php echo $form->error($model,'binnenkomst'); ?>
		</div>
	<?php }
	// In the case of a end post, the vertrek is not set. And we dont want users to change this.
	if ($model->vertrek != '0000-00-00 00:00:00' && $model->vertrek != null) { ?>
		<div class="row">
			<?php echo $form->labelEx($model,'vertrek'); ?>
			<?php $this->widget('application.extensions.timepicker.timepicker',
						array('model'=>$model,
						  'name'=>'vertrek',
						  'options'=>array(
								   'showAnim'=>'slide',
								   'showSecond'=>false,
								   'ampm'=>false,
								   'value'=>date("Y-m-d H:i", $model->vertrek), 
								   'dateFormat'=>'yy-mm-dd',
								   'changeMonth' => false,
								   'changeYear' => false,
								   'showOn'=>'focus',
								   'timeFormat'=>'hh:mm',
								   'showPeriodLabels' => false,
								   'showNowButton'=>true,
								   ),
						  )
						);?>
			<?php echo $form->error($model,'vertrek'); ?>
		</div>
	<?php } ?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->