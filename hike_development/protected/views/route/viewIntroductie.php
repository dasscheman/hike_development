<?php
// Created: 2014
// Modified: 23 feb 2015

/* @var $this RouteController */
/* @var $model Route */

$this->breadcrumbs=array(
	'Startup Spel Overzicht'=>array('/startup/startupOverview','event_id'=>$_GET['event_id']),
);
$this->menu=array(
    array('label'=>'Introductie Vraag Maken',
        'url'=>array('/OpenVragen/createIntroductie',
            'event_id'=>$_GET['event_id']),
        'visible'=> OpenVragen::model()->isActionAllowed('openVragen', 'createIntroductie', $_GET['event_id'])),
    array('label'=>'Introductie Stille Post Maken',
        'url'=>array('/Qr/createIntroductie',
            'event_id'=>$_GET['event_id']),
        'visible'=> Qr::model()->isActionAllowed('qr', 'createIntroductie', $_GET['event_id']),
       'linkOptions' => array('confirm'=>'Wil je een Stille post aanmaken? Als je ok klikt wordt er een stillepost aangemaakt.') ),);
?>

<h1>Bekijk alle introductie onderdelen voor <?php echo EventNames::model()->getEventName($_GET['event_id']); ?></h1>
<h2>Introductie vragen:</h2>
<?php

$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$vragenData,
    'itemView'=>'/openVragen/_view',
    'enablePagination' => false,
    'summaryText'=>'',
    'emptyText'=>'Je hebt nog geen enkele introductie vragen.',
));
?>

<h2>Introductie stille posten:</h2>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$qrData,
    'itemView'=>'/qr/_view',
    'enablePagination' => false,
    'summaryText'=>'',
    'emptyText'=>'Je hebt nog geen stille post gemaakt voor de introductie.',
));?>
