<?php
// Created: 2014
// Modified: 26 jan 2015

/* @var $this OpenNoodEnvelopController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	//'Startup Spel Overzicht'=>array('/game/gameOverview','event_id'=>$_GET['event_id']),
	'Vorige'=>array($_GET['previous'],'event_id'=>$_GET['event_id']),
	
);
?>

<h1>Alle geopende hints<sup><small>
							<?php echo CHtml::link('<i class="fa fa-question-circle fa-inverse"></i>',
							array('/site/help#GeopendeHints'),
							array('target'=>'_blank')); ?>
						</small></sup></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'enablePagination' => false,
	'summaryText'=>'', 
	'emptyText'=>'Er zijn geen geopende hints',
)); ?>
