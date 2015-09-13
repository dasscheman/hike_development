<?php
// Created: 2014
// Modified: 25 dec 2014

/* @var $this RouteController */
/* @var $model Route */

$this->breadcrumbs=array(
	'Startup Spel Overzicht'=>array('/startup/startupOverview','event_id'=>$model->event_ID),
	'Route Overzicht'=>array('/route/index','event_id'=>$model->event_ID),
);

$this->menu=array(
	array('label'=>'Vraag toevoegen', 
		  'url'=>array(
			'openVragen/create',
			'route_id'=>$model->route_ID,
			'event_id'=>$model->event_ID),
		'visible'=> Route::model()->isActionAllowed('openVragen', 'create', $_GET['event_id'])),
	array('label'=>'Stille post toevoegen', 
		  'url'=>array(
			'qr/create',
			'route_id'=>$model->route_ID,
			'event_id'=>$model->event_ID),
		'visible'=> Route::model()->isActionAllowed('qr', 'create', $_GET['event_id'])),
	array('label'=>'Hint toevoegen', 
		  'url'=>array(
			'noodEnvelop/create',
			'route_id'=>$model->route_ID,
			'event_id'=>$model->event_ID),
		'visible'=> Route::model()->isActionAllowed('noodEnvelop', 'create', $_GET['event_id'])),
	array('label'=>'Naam wijzigen', 
		  'url'=>array(
			'update', 
			'route_id'=>$model->route_ID,
			'event_id'=>$model->event_ID),
		'visible'=> Route::model()->isActionAllowed('route', 'update', $_GET['event_id'], $model->route_ID)),
	array('label'=>'Verwijderen',
		'url'=>'#',
		'linkOptions'=>array(
			'submit'=>array(
				'delete',
				'id'=>$model->route_ID,
				'event_id'=>$model->event_ID),
				'confirm'=>'Are you sure you want to delete this item?'),
		'visible'=> Route::model()->isActionAllowed('route', 'delete', $_GET['event_id'], $model->route_ID)),
);

?>

<h1>Overzicht Routeonderdeel</h1>

<?php
    $this->widget('bootstrap.widgets.TbDetailView', array(
        'data'=>$model,
        'attributes'=>array(
            array(
                'name'=>'Route Onderdeel',
                'value'=>Route::model()->getRouteName($model->route_ID)),
            //'route_ID',
            //'event_ID',
            'day_date',
            'route_volgorde',
            //'create_time',
            //'create_user_ID',
            //'update_time',
            //'update_user_ID',
        ),
    ));
 
    $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$vragenDataProvider,
        'itemView'=>'/openVragen/_view',
        'enablePagination' => true,
        'summaryText'=>'',
        'emptyText'=>'Er zijn nog geen vragen gemaakt voor dit routeonderdeel.',
    ));

    $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$envelopDataProvider,
        'itemView'=>'/noodEnvelop/_view',
        'emptyText'=>'Er zijn nog geen hint gemaakt voor dit routeonderdeel.',
    ));

    $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$qrDataProvider,
        'itemView'=>'/qr/_view',
        'emptyText'=>'Er zijn nog geen stille posten gemaakt voor dit routeonderdeel.',
    ));
?>
