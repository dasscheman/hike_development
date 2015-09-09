<?php
/* @var $this NoodEnvelopController */
/* @var $model NoodEnvelop */


$this->breadcrumbs=array(
	'Spel Overzicht'=>array('/game/gameOverview','event_id'=>$_GET['event_id']),
	'Groeps Overzicht'=>array('/game/groupOverview',
                                'event_id'=>$_GET['event_id'],
                                'group_id'=>$_GET['group_id'])
);
?>

<h2>Hints<sup><small>
				<?php echo CHtml::link('<i class="fa fa-question-circle fa-inverse"></i>',
				array('/site/help#Hints'),
				array('target'=>'_blank')); ?>
			 </small></sup></h2>
<center> Hier staan hints die je kunt openen als je er niet meer uitkomt. De titel 
     van de hint geeft aan wat de hint inhoudt. De meeste hints zijn coordinaten 
     zodat je de route vanaf daar weer kan oppakken. <br/>

     Er zijn ook hints die een aanwijzing geven hoe je het routeonderdeel kan oplossen. <br/> 
     Als je een hint opent dan krijg je strafpunten, niet alle hints geven even 
     veel strafpunten. Eenmaal geopende, kan een hint niet meer gesloten worden. 
     Dus als je perongeluk een verkeerde hint open maakt, dan heb je 
     pech. </center> 
<i> Je ziet alleen de hints van vandaag.</i>
<?php 
	foreach($noodEnvelopDataProvider->data as $obj){
		$hintData[]['header']='Hint naam: ' . $obj->nood_envelop_name;
		if(!OpenNoodEnvelop::model()->isEnvelopOpenByGroup($obj->nood_envelop_ID,
										  $_GET['event_id'],
										  $_GET['group_id']))
		{
			$hintData[] = array(
				'oneRow'=>true,
				'type'=>'raw',
				'name'=>CHtml::button('OPENEN',
						array('submit' => array('/openNoodEnvelop/create',
							  'nood_envelop_id'=>$obj->nood_envelop_ID,
							  'event_id'=>$_GET['event_id'],
							  'group_id'=>$_GET['group_id']),
						'confirm'=>'Weet je zeker dat je deze envelop open wilt maken?'))
			);		   
		} else {
			$hintData[] = array(
				'oneRow'=>true,
				'type'=>'raw',
				'value'=>"GEOPEND");
		}
		$hintData[] = array(
			'name'=>'Hike dag',
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>Route::model()->getDayOfRouteId($obj->route_ID)
		);
		$hintData[] = array(
			'name'=>'Route onderdeel',
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>Route::model()->getRouteName($obj->route_ID)
		);
		$hintData[] = array(
			'name'=>'Strafpunten',
			'oneRow'=>true,
			'type'=>'raw',
			'value'=>$obj->score
		);
	}
	if (!isset($hinttData)){
		$hintData[] = array(
				'value'=>'Er zijn geen hints',
				'oneRow'=>true);
	}
	$this->widget('ext.widgets.DetailView4Col', array(
		'data'=>$noodEnvelopDataProvider,
		'attributes'=>$hintData,
	)); ?>