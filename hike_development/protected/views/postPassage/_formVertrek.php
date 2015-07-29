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

<!--
	<div class="row">
		<?php /*echo $form->labelEx($model,'event_ID'); ?>
		<?php echo $form->textField($model,'event_ID');?>
		<?php echo $form->error($model,'event_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'post_ID'); ?>
		<?php echo $form->textField($model,'post_ID'); ?>
		<?php echo $form->error($model,'post_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'day_ID'); ?>
		<?php echo $form->textField($model,'day_ID'); ?>
		<?php echo $form->error($model,'day_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'group_ID'); ?>
		<?php echo $form->textField($model,'group_ID'); ?>
		<?php echo $form->error($model,'group_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gepasseerd'); ?>
		<?php echo $form->textField($model,'gepasseerd'); ?>
     		<?php echo $form->error($model,'gepasseerd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'binnenkomst'); ?>
		<?php echo $form->textField($model,'binnenkomst'); ?>
        	<?php echo $form->error($model,'binnenkomst');*/?>
	</div>
-->
	<div class="row">
		
		
		<?php echo $form->labelEx($model,'vertrek'); ?>
		<?php $this->widget('application.extensions.timepicker.timepicker',
				    array('model'=>$model,
					  'name'=>'vertrek',
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
		     /* echo $form->textField($model,
                                    'binnenkomst', 
                                     array('value'=>date("Y-m-d H:i:s", time()),
					   'readonly' => 'true')
                                     );*/?>
		<?php echo $form->error($model,'vertrek'); ?>
	</div>

<!--
	<div class="row">
		<?php /*echo $form->labelEx($model,'score'); ?>
		<?php echo $form->textField($model,'score'); ?>
		<?php echo $form->error($model,'score'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_time'); ?>
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