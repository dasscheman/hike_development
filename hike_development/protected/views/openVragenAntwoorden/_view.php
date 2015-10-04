<?php
// Created: 2014
// Modified: 26 jan 2015

/* @var $this OpenVragenAntwoordenController */
/* @var $data OpenVragenAntwoorden */
?>

<div class="view">
<?php
	$vraagtData[]['header']=Groups::model()->getAttributeLabel('group_name') . ': ' . Groups::model()->getGroupName($data->group_ID);
	
	$vraagtData[] = array(
		'name'=>OpenVragen::model()->getAttributeLabel('vraag'),
		'oneRow'=>true,
		'type'=>'raw',
		'value'=>OpenVragen::model()->getOpenVraag($data->open_vragen_ID)
	);
	$vraagtData[] = array(
		'name'=>$data->getAttributeLabel('antwoord_spelers'),
		'oneRow'=>false,
		'type'=>'raw',
		'value'=>$data->antwoord_spelers
	);
	$vraagtData[] = array(
		'name'=>OpenVragen::model()->getAttributeLabel('goede_antwoord'),
		'oneRow'=>false,
		'type'=>'raw',
		'value'=>OpenVragen::model()->getOpenVraagAntwoord($data->open_vragen_ID)
	);
	$vraagtData[] = array(
		'name'=>$data->getAttributeLabel('checked'),
		'oneRow'=>false,
		'type'=>'raw',
		'value'=>GeneralFunctions::getJaNeeText($data->checked)
	);
	$vraagtData[] = array(
		'name'=>$data->getAttributeLabel('correct'),
		'oneRow'=>false,
		'type'=>'raw',
		'value'=>GeneralFunctions::getJaNeeText($data->correct)
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
		'name'=>OpenVragen::model()->getAttributeLabel('score'),
		'oneRow'=>true,
		'type'=>'raw',
		'value'=>OpenVragen::model()->getOpenVraagScore($data->open_vragen_ID)
	);	
	if (!isset($vraagtData)){
		$vraagtData[] = array(
				'value'=>'Er zijn geen vragen beantwoord',
				'oneRow'=>true);
	}
	if (OpenVragenAntwoorden::model()->isActionAllowed('openVragenAntwoorden', 'updateOrganisatie', $data->event_ID))
	{
		$vraagtData[] = array(
			'oneRow'=>true,
			'type'=>'raw',
			'value'=>CHtml::link('<span class="fa-stack fa-lg">
									<i class="fa fa-circle fa-stack-2x fa-green"></i>
									<i class="fa fa-file-o fa-stack-1x"></i>
									<i class="fa fa-blue fa-text-right fa-09x">Bewerken</i>
									<i class="fa fa-refresh fa-stack-up-15p fa-blue fa-06x"></i>
							  </span>',
							  array('/openVragenAntwoorden/updateOrganisatie',
									'event_id'=>$data->event_ID,
									'group_id'=>$data->group_ID,
									'vraag_id'=>$data->open_vragen_ID))
		);
	}
	
	$this->widget('ext.widgets.DetailView4Col', array(
		'data'=>$data,
		'attributes'=>$vraagtData,
	)); ?>
</div>