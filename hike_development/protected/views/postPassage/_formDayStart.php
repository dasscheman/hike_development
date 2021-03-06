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
		<?php echo $form->hiddenField($model,
					      'event_ID',
					      array('value'=>$_GET['event_id'],
						    'readonly' => 'true'));?>
		<?php echo $form->error($model,'event_ID'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'post_ID'); ?>
		<?php echo $form->dropDownList($model,'post_ID', Posten::model()->getPostNameOptionsToday($_GET['event_id']));?>
		<?php echo $form->error($model,'post_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,
					      'group_ID',
					      array('value'=>$_GET['group_id'],
						    'readonly' => 'true'));?>
		<?php echo $form->error($model,'group_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vertrek'); ?>

		<?php $this->widget('application.extensions.timepicker.timepicker',
				    array('model'=>$model,
					  'name'=>'vertrek',
					  'options'=>array(
							   'showAnim'=>'fadeIn',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
							   'showSecond'=>false,
							   'ampm'=>false,
							   'value'=>date("Y-m-d H:i", time()),
							   'dateFormat'=>'yy-mm-dd',
							   'changeMonth' => false,
							   'changeYear' => false,
							   'showOn'=>'focus',//button
							   'timeFormat'=>'hh:mm',
							   'showPeriodLabels' => false,
								'showNowButton'=>true,
							   ),
					  )
				    );
		     /* echo $form->textField($model,
                                    'binnenkomst', 
                                     array('value'=>date("Y-m-d H:i:s", time()),
					   'readonly' => 'true')
                                     );*/?>
		<?php echo $form->error($model,'vertrek'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->