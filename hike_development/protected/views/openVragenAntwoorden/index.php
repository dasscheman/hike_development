<?php
// Created: 2014
// Modified: 26 jan 2015

/* @var $this OpenVragenAntwoordenController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Vorige'=>array($_GET['previous'],'event_id'=>$_GET['event_id']),
);
?>

<h1>Alle beantwoorde vragen<sup><small>
							<?php echo CHtml::link('<i class="fa fa-question-circle fa-inverse"></i>',
							array('/site/help#BeantwoordeVragen'),
							array('target'=>'_blank')); ?>
						</small></sup></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'enablePagination' => true,
	'summaryText'=>'', 
	'emptyText'=>'Er zijn geen beantwoorde vragen',
)); ?>
