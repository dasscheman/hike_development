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
		<?php //echo $form->labelEx($model,'event_ID'); ?>
		<?php //echo $form->textField($model,'event_ID'); 
		      echo $form->hiddenField($model,
					      'event_ID',
					      array('value'=>$_GET['event_id'],
						    'readonly' => 'true'))
                                     ;?>
		<?php echo $form->error($model,'event_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'post_ID'); ?>
		<?php //echo $form->textField($model,'post_ID'); 
              echo $form->dropDownList($model,
				       'post_ID', 
                                       Posten::model()->getPostNameOptions($_GET['event_id']),
                                       array('ajax' => array(
                                                        'url' => CController::createUrl('dynamicPostScore'),
                                                        'type' => 'POST',                     
                                                        'update'=>'#PostPassage_score',
                                                        'data'=>array('post_ID'=>'js:this.value')),
                                              'empty' => '--Selecteer een Post--', 'style'=>'width:150px;')); 
              //echo $form->dropDownList($model,'post_ID', Posten::model()->getPostNameOptions($_GET['event_id']));?>
		<?php echo $form->error($model,'post_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'day_ID'); ?>
		<?php //echo $form->textField($model,'day_ID'); 
                      echo $form->dropDownList($model,
					       'day_ID',
					       EventNames::model()->getDatesAvailable($_GET['event_id']));?>
		<?php echo $form->error($model,'day_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'group_ID'); ?>
		<?php //echo $form->textField($model,'group_ID'); 
                      echo $form->dropDownList($model,
					       'group_ID',
					       Groups::model()->getGroupOptions());?>
		<?php echo $form->error($model,'group_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gepasseerd'); ?>
	<div class="row compactRadioGroup">
		<?php //echo $form->textField($model,'gepasseerd'); 
              echo $form->radioButtonList($model,'gepasseerd', 
                        array(  0 => 'Nee',
                                1 => 'Ja'), 
                        array( 'separator' => "" ) ); ?>
	</div>
		<?php echo $form->error($model,'gepasseerd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'binnenkomst'); ?>
		<?php //echo $form->textField($model,'binnenkomst'); 
                      echo $form->textField($model,
					    'binnenkomst',
					    array('value'=>date("Y-m-d H:i:s", time()),
						  'readonly' => 'true')
					    );?>
		<?php echo $form->error($model,'binnenkomst'); ?>
	</div>
<!--
	<div class="row">
		<?php //echo $form->labelEx($model,'vertrek'); ?>
		<?php //echo $form->textField($model,'vertrek'); ?>
		<?php //echo $form->error($model,'vertrek'); ?>
	</div>
-->
	<div class="row">
		<?php echo $form->labelEx($model,'score'); ?>
		<?php //echo $form->textField($model,'score'); 
              echo CHtml::dropDownList('PostPassage[score]',"", array(), array('prompt'=> '--Selecteer eerst een Post--', 'style'=>'width:200px;'));
        /*echo $form->textField($model,
                                    'score', 
                                     array('value'=>Posten::model()->getPostScore($model->post_ID), 
                                        'readonly' => 'true')
                                     );*/?>
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