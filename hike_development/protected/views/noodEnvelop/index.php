<?php
// Created: 2014
// Modified: 12 jan 2015

/* @var $this NoodEnvelopController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Startup Spel Overzicht'=>array('/startup/startupOverview','event_id'=>$_GET['event_id']),
);

?>

<h1>Overzicht van hints</h1>
<p>
	Je kunt klikken op een hint om die te bewerken, het aanmaken van hints moet via de route beheer. 
</p>
<?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id'=>'nood-envelop-grid',
        'dataProvider'=>$hintsData->searchHints($_GET['event_id']),
        //'filter'=>$model,
        'columns'=>array(
            array(
                'header'=>'Titel',
                'type'=> 'raw',
                'value'=>'CHtml::link($data->nood_envelop_name, array(
                    "/noodEnvelop/update",
                    "nood_envelop_id"=>$data->nood_envelop_ID,
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
                'header'=>'Route Onderdeel',
                'value'=>'Route::model()->getRouteName($data->route_ID)'),
            array(
                'header'=>'Dag',
                'value'=>'Route::model()->getDayOfRouteId($data->route_ID)'),
            'coordinaat',
            'opmerkingen',
            'score',
       /*     array(
                'header'=>'Opties',
                'class'=>'CButtonColumn',
                'template'=>'{details}',
                'buttons'=>array(
                    'details' => array(
                        'label'=>'<span class="fa-stack fa-lg">
                                    <i class="fa fa-search fa-stack-1x"></i>
                                  </span>',
                        'options'=>array('title'=>'Bekijk deze hint'),
                        'url'=>'Yii::app()->createUrl("route/view", array(
                            "route_id"=>$data->route_ID,
                            "event_id"=>$data->event_ID,))',
                    ),
                ),
            ),*/
    )
)); ?>
