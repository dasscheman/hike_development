<?php
/* @var $this OpenVragenController */
/* @var $model OpenVragen */

$this->breadcrumbs=array(
	'Spel Overzicht'=>array('/game/gameOverview','event_id'=>$_GET['event_id']),
	'Groeps Overzicht'=>array('/game/groupOverview',
                                'event_id'=>$_GET['event_id'],
                                'group_id'=>$_GET['group_id'])
);

?>

	<h2>Beantwoorde Vragen
		<sup><small>
			<?php echo CHtml::link('<i class="fa fa-question-circle fa-inverse"></i>',
			array('/site/help#BeantwoordeVragen'),
			array('target'=>'_blank')); ?>
		 </small></sup>
	</h2>
<?php
	foreach($openVragenAntwoordenDataProvider->data as $obj){
		$vraagtData[]['header']='Vraag naam: ' . OpenVragen::model()->getOpenVragenName($obj->open_vragen_ID);
		if (OpenVragenAntwoorden::model()->isActionAllowed('openVragenAntwoorden',
												'update',
												$obj->event_ID,
												"",
												$_GET['group_id']) &&
			OpenVragenAntwoorden::model()->isVraagGecontroleerd($obj->event_ID,
																$_GET['group_id'],
																$obj->open_vragen_ID) == 'Nee')
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
										'event_id'=>$obj->event_ID,
										'group_id'=>$_GET['group_id'],
										'vraag_id'=>$obj->open_vragen_ID))
			);
		}
		$vraagtData[] = array(
			'name'=>'Hike dag',
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>OpenVragen::model()->getVraagDag($obj->open_vragen_ID)
		);
		$vraagtData[] = array(
			'name'=>'Route onderdeel',
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>OpenVragen::model()->getRouteOnderdeelVraag($obj->open_vragen_ID)
		);
		$vraagtData[] = array(
			'name'=>'Vraag',
			'oneRow'=>true,
			'type'=>'raw',
			'value'=>OpenVragen::model()->getOpenVraag($obj->open_vragen_ID)
		);
		$vraagtData[] = array(
			'name'=>'Antwoord speler',
			'oneRow'=>true,
			'type'=>'raw',
			'value'=>$obj->antwoord_spelers
		);
		$vraagtData[] = array(
			'name'=>'Gecontroleerd',
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>GeneralFunctions::getJaNeeText($obj->checked)
		);
		$vraagtData[] = array(
			'name'=>'Correct',
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>GeneralFunctions::getJaNeeText($obj->correct)
		);
		$vraagtData[] = array(
			'name'=>$obj->getAttributeLabel('create_user_ID'),
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>Users::model()->getUserName($obj->create_user_ID)
		);
		$vraagtData[] = array(
			'name'=>$obj->getAttributeLabel('create_time'),
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>$obj->create_time
		);
		$vraagtData[] = array(
			'name'=>OpenVragen::model()->getAttributeLabel('score'),
			'oneRow'=>true,
			'type'=>'raw',
			'value'=>OpenVragen::model()->getOpenVraagScore($obj->open_vragen_ID)
		);
	}
	if (!isset($vraagtData)){
		$vraagtData[] = array(
				'value'=>'Er zijn geen vragen beantwoord',
				'oneRow'=>true);
	}
	$this->widget('ext.widgets.DetailView4Col', array(
		'data'=>$openVragenAntwoordenDataProvider,
		'attributes'=>$vraagtData,
	)); ?>