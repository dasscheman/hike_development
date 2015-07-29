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
		<?php echo $form->labelEx($model,'binnenkomst'); ?>
		<?php $this->widget('application.extensions.timepicker.timepicker',
				    array('model'=>$model,
					  'name'=>'binnenkomst',
					  'options'=>array(
							   'showAnim'=>'slide',
							   'showSecond'=>false,
							   'ampm'=>false,
							   'value'=>date("Y-m-d H:i", time()), 
							   //'timeFormat' => 'hh.mm.ss.000000 tt',
							   'dateFormat'=>'yy-mm-dd',
							   'changeMonth' => false,
							   'changeYear' => false,
							   'showOn'=>'focus',
							   'timeFormat'=>'hh:mm',
							   //'hourMin'=> (int) $hourMin,
							   //'hourMax'=> (int) $hourMax,
							   'showPeriodLabels' => false,
							   'showNowButton'=>true,
							   ),
					  )
				    );
		      /*echo $form->textField($model,
                                    'binnenkomst', 
                                     array('value'=>date("Y-m-d H:i:s", time()), 
                                        'readonly' => 'false')
                                     );*/?>
		<?php echo $form->error($model,'binnenkomst'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->