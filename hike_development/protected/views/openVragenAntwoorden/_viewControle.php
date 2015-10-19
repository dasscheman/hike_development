<?php
// Created: 2014
// Modified: 26 jan 2015

/* @var $this OpenVragenAntwoordenController */
/* @var $data OpenVragenAntwoorden */

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
$vraagtData[] = array(
	'name'=>'Goed',
	'oneRow'=>false,
	'type'=>'raw',
	'value'=>CHtml::link('<span class="fa-stack fa-lg">
							<i class="fa fa-circle fa-stack-2x fa-green"></i>
							<i class="fa fa-file-o fa-stack-1x"></i>
							<i class="fa fa-check fa-stack-40p fa-blue fa-06x"> </i>
						  </span>', 
						  array('/openVragenAntwoorden/antwoordGoedOfFout',
								   'id'=>$data->open_vragen_antwoorden_ID,
								   'goedfout'=>1,
								   'event_id'=>$_GET['event_id']))
);
$vraagtData[] = array(
	'name'=>'Fout',
	'oneRow'=>false,
	'type'=>'raw',
	'value'=>CHtml::link('<span class="fa-stack fa-lg">
							<i class="fa fa-circle fa-stack-2x fa-green"></i>
							<i class="fa fa-file-o fa-stack-1x"></i>
							<i class="fa fa-times fa-stack-40p fa-blue fa-06x"></i>
						  </span>', 
						  array('/openVragenAntwoorden/antwoordGoedOfFout',
								'id'=>$data->open_vragen_antwoorden_ID,
								'goedfout'=>0,
								'event_id'=>$_GET['event_id']))
);
if (!isset($vraagtData)){
	$vraagtData[] = array(
			'value'=>'Er zijn geen vragen beantwoord',
			'oneRow'=>true);
}
if (OpenVragenAntwoorden::model()->isActionAllowed('openVragenAntwoorden',
										'update',
										$data->event_ID,
										"",
										$data->group_ID) &&
	OpenVragenAntwoorden::model()->isVraagGecontroleerd($data->event_ID,
														$data->group_ID,
														$data->open_vragen_ID) == 'Nee')
{
	$vraagtData[] = array(
		'oneRow'=>true,
		'type'=>'raw',
		'value'=>CHtml::link('<span class="fa-stack fa-lg">
								<i class="fa fa-circle fa-stack-2x fa-green"></i>
								<i class="fa fa-file-o fa-stack-1x"></i>
								<i class="fa fa-blue fa-text-right fa-09x"> Bewerken</i>
								<i class="fa fa-refresh fa-stack-up-15p fa-blue fa-06x"> </i>
						  </span>',
						  array('/openVragenAntwoorden/update',
								'event_id'=>$data->event_ID,
								'group_id'=>$_GET['group_id'],
								'vraag_id'=>$data->open_vragen_ID))
	);
}

$this->widget('ext.widgets.DetailView4Col', array(
	'data'=>$data,
	'attributes'=>$vraagtData,
)); ?>