<?php
// Created: 2014
// Modified: 18 jan 2015

/* @var $this OpenVragenController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Startup Spel Overzicht'=>array('/startup/startupOverview','event_id'=>$_GET['event_id']),
);

/*$this->menu=array(
        array('label'=>'Vraag Maken',
	      'url'=>array('/OpenVragen/create',
			   'event_id'=>$_GET['event_id']),
	      'visible'=> OpenVragen::model()->isActionAllowed('openVragen', 'create', $_GET['event_id'])),
);*/
?>

<h1>Vragen</h1>
<p>
	Je kunt klikken op een vraag om die te bewerken, het aanmaken van vragen moet via de route beheer. 
</p>
<?php

    $this->widget('bootstrap.widgets.TbGridView', array(
        'id'=>'open-vragen-grid',
        'dataProvider'=>$vragenData->searchOpenVragen($_GET['event_id']),
        //'filter'=>$model,
        'columns'=>array(
            array(
                'header'=>'Titel',
                'type'=> 'raw',
                'value'=>'CHtml::link($data->open_vragen_name, array(
                    "/openVragen/update",
                    "id"=>$data->open_vragen_ID,
                    "event_id"=>$data->event_ID))',
                ),            
            array(
                'header'=>'Route Onderdeel',
                'type'=> 'raw',
                'value'=>'CHtml::link(Route::model()->getRouteName($data->route_ID), array(
                    "route/view",
                    "route_id"=>$data->route_ID,
                    "event_id"=>$data->event_ID))',
                ),          
            array(
                'header'=>'Dag',
                'value'=>'Route::model()->getDayOfRouteId($data->route_ID)'),
            'omschrijving',
            'vraag',
            'goede_antwoord',
            'score',
            /*array(
                'header'=>'Opties',
                'class'=>'CButtonColumn',
                'template'=>'{details}',
                'buttons'=>array(
                    'details' => array(
                        'label'=>'<span class="fa-stack fa-lg">
                                    <i class="fa fa-search fa-stack-1x"></i>
                                  </span>',
                        'options'=>array('title'=>'Bekijk deze vraag'),
                        'url'=>'Yii::app()->createUrl("route/view", array(
                            "route_id"=>$data->route_ID,
                            "event_id"=>$data->event_ID,))',
                    ),
                ),
            ),*/
    )
)); ?>