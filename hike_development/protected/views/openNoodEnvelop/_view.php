<?php
// Created: 2014
// Modified: 26 jan 2015

/* @var $this OpenNoodEnvelopController */
/* @var $data OpenNoodEnvelop */
?>

<div class="view">
<?php
	$vraagtData[]['header']=Groups::model()->getAttributeLabel('group_name') . ': ' . Groups::model()->getGroupName($data->group_ID);
	
	$vraagtData[] = array(
		'name'=>NoodEnvelop::model()->getAttributeLabel('nood_envelop_name'),
		'oneRow'=>true,
		'type'=>'raw',
		'value'=>NoodEnvelop::model()->getNoodEnvelopName($data->nood_envelop_ID)
	);
	$vraagtData[] = array(
		'name'=>NoodEnvelop::model()->getAttributeLabel('date'),
		'oneRow'=>false,
		'type'=>'raw',
		'value'=>NoodEnvelop::model()->getEventDayOfEnvelop($data->nood_envelop_ID)
	);
	$vraagtData[] = array(
		'name'=>Route::model()->getAttributeLabel('name'),
		'oneRow'=>false,
		'type'=>'raw',
		'value'=>NoodEnvelop::model()->getRouteNameOfEnvelopId($data->nood_envelop_ID)
	);
	$vraagtData[] = array(
		'name'=>NoodEnvelop::model()->getAttributeLabel('coordinaten'),
		'oneRow'=>false,
		'type'=>'raw',
		'value'=>NoodEnvelop::model()->getCoordinaten($data->nood_envelop_ID)
	);
	$vraagtData[] = array(
		'name'=>NoodEnvelop::model()->getAttributeLabel('opmerkingen'),
		'oneRow'=>false,
		'type'=>'raw',
		'value'=>NoodEnvelop::model()->getOpmerkingen($data->nood_envelop_ID)
	);
	$vraagtData[] = array(
		'name'=>$data->getAttributeLabel('create_user_ID'),
		'oneRow'=>false,
		'type'=>'raw',
		'value'=>Users::model()->getUserName($data->create_user_ID)
	);
	$vraagtData[] = array(
		'name'=>$data->getAttributeLabel('create_time'),
		'oneRow'=>false,
		'type'=>'raw',
		'value'=>$data->create_time
	);
	$vraagtData[] = array(
		'name'=>NoodEnvelop::model()->getAttributeLabel('score'),
		'oneRow'=>true,
		'type'=>'raw',
		'value'=>NoodEnvelop::model()->getNoodEnvelopScore($data->nood_envelop_ID)
	);
	if (!isset($vraagtData)){
		$vraagtData[] = array(
				'value'=>'Er zijn geen vragen beantwoord',
				'oneRow'=>true);
	}
	if (OpenNoodEnvelop::model()->isActionAllowed('openNoodEnvelop', 'update', $data->event_ID))
	{
		$vraagtData[] = array(
			'oneRow'=>true,
			'type'=>'raw',
			'value'=>CHtml::link('<span class="fa-stack fa-lg">
							<i class="fa fa-pencil fa-stack-1x"></i>
							<i class="fa fa-blue fa-text-right fa-07x"> Wijzigen </i>
					  </span>',
					  array('openNoodEnvelop/update',
							'id'=>$data->open_nood_envelop_ID,
							'event_id'=>$data->event_ID,
							'group_id'=>$data->group_ID))
		);
	}
	
	$this->widget('ext.widgets.DetailView4Col', array(
		'data'=>$data,
		'attributes'=>$vraagtData,
	));?>

</div>