<?php
// Created: 2014
// Modified: 26 jan 2015

/* @var $this PostPassageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Vorige'=>array($_GET['previous'],'event_id'=>$_GET['event_id']),
);
?>

<h1>Gepasserde Posten<sup><small>
				<?php echo CHtml::link('<i class="fa fa-question-circle fa-inverse"></i>',
				array('/site/help#PostPassages'),
				array('target'=>'_blank')); ?>
			   </small></sup></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'enablePagination' => true,
	'summaryText'=>'', 
	'emptyText'=>'Er zijn geen posten gepasseerd',
)); ?>
