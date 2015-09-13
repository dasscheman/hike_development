<?php
// Created: 2014
// Modified: 26 jan 2015

/* @var $this OpenVragenAntwoordenController */
/* @var $dataProvider CActiveDataProvider */

?>

<h1>Antwoorden Controleren<sup><small>
							<?php echo CHtml::link('<i class="fa fa-question-circle fa-inverse"></i>',
							array('/site/help#AntwoordenControleren'),
							array('target'=>'_blank')); ?>
						  </small></sup></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_viewControle',
	'enablePagination' => true,
	'summaryText'=>'', 
	'emptyText'=>'Er zijn geen vragen die nog gecontroleerd moeten worden.',
)); ?>
