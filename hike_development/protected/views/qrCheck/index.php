<?php
// Created: 2014
// Modified: 26 jan 2015

/* @var $this QrCheckController */
/* @var $dataProvider CActiveDataProvider */


$this->breadcrumbs=array(
	'Vorige'=>array($_GET['previous'],'event_id'=>$_GET['event_id']),
);

?>

<h1>Stille Posten<sup><small>
				<?php echo CHtml::link('<i class="fa fa-question-circle fa-inverse"></i>',
				array('/site/help#StillePosten'),
				array('target'=>'_blank')); ?>
			   </small></sup></h1>

<?php $this->widget('zii.widgets.CListView',
		    array('dataProvider'=>$dataProvider,
			  'itemView'=>'_view',
			  'enablePagination' => false,
			  'summaryText'=>'',
			  'emptyText'=>'Er is nog geen enkele stille post gevonden.',
)); ?>