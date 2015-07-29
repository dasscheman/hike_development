<?php
/* @var $this QrController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Startup Spel Overzicht'=>array('/startup/startupOverview','event_id'=>$_GET['event_id']),
);
/*
$this->menu=array(
	array('label'=>'Stille Post Maken', 'url'=>array('create', 'event_id'=>$_GET['event_id'])),
);*/
?>

<h1>Stille Posten</h1>
<p>
	Je kunt klikken op een stille post om die te bewerken, het aanmaken van stille posten moet via de route beheer. 
</p>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
Omdat zo'n handig QR-Code generator hebben een <a href="http://www.mobile-barcodes.com/"> linkje. </a>