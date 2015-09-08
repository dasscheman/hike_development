<?php
/* @var $this QrCheckController */
/* @var $dataProvider CActiveDataProvider */


$this->breadcrumbs=array(
	'Spel Overzicht'=>array('/game/gameOverview','event_id'=>$_GET['event_id']),
	'Groeps Overzicht'=>array('/game/groupOverview',
                                'event_id'=>$_GET['event_id'],
                                'group_id'=>$_GET['group_id'])
);

?>

<h1>Stille Posten
	<sup><small>
		<?php echo CHtml::link('<i class="fa fa-question-circle fa-inverse"></i>',
		array('/site/help#StillePosten'),
		array('target'=>'_blank')); ?>
	</small></sup>
</h1>

<center> Een lijstje met stille posten die jullie gepasseerd zijn </center>
<?php
	foreach($qrCheckDataProvider->data as $obj){
		$qrData[]['header']='Stille post naam: ' . Qr::model()->getQrCodeName($obj->event_ID, $obj->qr_ID);

		$qrData[] = array(
			'name'=>'Hike dag',
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>Route::model()->getDayOfRouteId(Qr::model()->getQrRouteID($obj->qr_ID))
		);
		$qrData[] = array(
			'name'=>'Route onderdeel',
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>Route::model()->getRouteName(Qr::model()->getQrRouteID($obj->qr_ID))
		);
		$qrData[] = array(
			'name'=>$obj->getAttributeLabel('create_time'),
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>$obj->create_time
		);
		$qrData[] = array(
			'name'=>$obj->getAttributeLabel('create_user_ID'),
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>Users::model()->getUserName($obj->create_user_ID)
		);
		$qrData[] = array(
			'name'=>Qr::model()->getAttributeLabel('score'),
			'oneRow'=>true,
			'type'=>'raw',
			'value'=>Qr::model()->getQrScore($obj->qr_ID)
		);
	}
	if (!isset($qrData)){
		$qrData[] = array(
				'value'=>'Geen vragen voor vandaag',
				'oneRow'=>true);
	}
	$this->widget('ext.widgets.DetailView4Col', array(
		'data'=>$qrCheckDataProvider,
		'attributes'=>$qrData,
	)); ?>