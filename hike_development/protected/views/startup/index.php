<?php
/* @var $this StartupController */


/*
$this->menu=array(
				array('label'=>'Totalen', 'url'=>array('/turfTotals/index')),
				array('label'=>'Betalingen', 'url'=>array('/payments/index')),
				array('label'=>'Turflijsten', 'url'=>array('/turflijsten/index')),
				array('label'=>'Prijzen', 'url'=>array('/price/index')), //Da 1 juli 2013 eind nieuw
				array('label'=>'Mail', 'url'=>array('/mail/index')), //Da 3 juli 2013 nieuw
);*/
?>
<br>
<h1>Hike Overzicht</h1>
Dit is een overzicht van alle Hikes waarvoor je bent ingeschreven.
<?php 
    $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$deelnemersEventDataProvider,
        'itemView'=>'/startup/_overview',
        'emptyText'=>'Er zijn geen spellen waar je geregistreerd staat als organisatie',
        )
    ); ?>
