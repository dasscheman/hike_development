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

<?php 
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id'=>'open-vragen-grid',
        'dataProvider'=>$model->searchOpened($_GET['event_id']),
        'filter'=>$model,
        'columns'=>array(
			array(
                'header'=>Groups::model()->getAttributeLabel('group_name'),
				'name'=>'group_name',
				'value'=>'$data->group->group_name',
				'headerHtmlOptions'=>array('width'=>'10%'),
			),
			array(
                'header'=>NoodEnvelop::model()->getAttributeLabel('nood_envelop_name'),
				'name'=>'nood_envelop_name',
				'value'=>'$data->noodEnvelop->nood_envelop_name'
			),
			array(
                'header'=>Route::model()->getAttributeLabel('day_date'),
				'name'=>'day_date',
				'value'=>'$data->noodEnvelop->route->day_date'
			),
			array(
                'header'=>Route::model()->getAttributeLabel('route_name'),
				'name'=>'route_name',
				'value'=>'$data->noodEnvelop->route->route_name'
			),
			array(
                'header'=>Users::model()->getAttributeLabel('username'),
				'name'=>'username',
				'value'=>'$data->createUser->username'
			),
			array(
                'header'=>NoodEnvelop::model()->getAttributeLabel('score'),
				'name'=>'score',
				'value'=>'$data->noodEnvelop->score',
				'headerHtmlOptions'=>array('width'=>'3%'),
				'htmlOptions'=>array('style'=>'text-align:center'),
			),
			'create_time',
            array(
                'header'=>'Bewerken',
                'class'=>'CButtonColumn',
                'template'=>'{details}',
                'buttons'=>array(
                    'details' => array(
                        'label'=>'<span class="fa-stack fa-lg">
                                    <i class="fa fa-search fa-stack-1x"></i>
                                  </span>',
                        'options'=>array('title'=>'Bekijk deze hint'),
                        'url'=>'Yii::app()->createUrl("/openNoodEnvelop/update", array(
                            "event_id"=>$data->event_ID,
                            "group_id"=>$data->group_ID,
                            "id"=>$data->open_nood_envelop_ID,))',
                    ),
                ),
            ),
    )
));
?>
