<?php
// Created: 2014
// Modified: 26 jan 2015

/* @var $this BonuspuntenController */
/* @var $dataProvider CActiveDataProvider */
if(isset($_GET['previous'])){
	$goto = $_GET['previous'];
} else {
	$goto = '/game/gameOverview';
}

    $this->breadcrumbs=array(
        'Vorige'=>array($goto,'event_id'=>$_GET['event_id']),
    );
?>

<h1>Bonuspunten Overzicht<sup><small>
				<?php echo CHtml::link('<i class="fa fa-question-circle fa-inverse"></i>',
				array('/site/help#Bonuspunten'),
				array('target'=>'_blank')); ?>
			   </small></sup></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
