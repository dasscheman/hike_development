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

	<h2>Alle Vragen
		<sup><small>
			<?php echo CHtml::link('<i class="fa fa-question-circle fa-inverse"></i>',
			array('/site/help#Vragen'),
			array('target'=>'_blank')); ?>
		 </small></sup>
	</h2>
	<center> Hier een lijst met vragen. Als je en vraag beantwoordt, dan zal die in
		 redelijk korte termijn gecontroleerd worden door de organisatie. En als een
		 vraag eenmaal gecontroleerd is, dan kan je hem niet meer wijzigen. Dus
		 beantwoord ook alleen vragen als je werkelijk het antwoord denkt te weten.
	</center>

<i> Je ziet alleen de vragen van vandaag. Dus op zaterdag kan je niet alsnog vragen invullen voor vrijdag!</i>
<?php
	foreach($openVragenDataProvider->data as $obj){
		$vraagtData[]['header']='Vraag naam: ' . $obj->open_vragen_name;
		if (OpenVragenAntwoorden::model()->isActionAllowed('openVragenAntwoorden',
															'create',
															$obj->event_ID,
															"", //model_id
															$_GET['group_id']) &&
			OpenVragenAntwoorden::model()->isVraagBeantwoord($obj->event_ID,
															$_GET['group_id'],
															$obj->open_vragen_ID) == 'Nee')
		{
			$vraagtData[] = array(
				'oneRow'=>true,
				'type'=>'raw',
				'value'=>CHtml::link('<span class="fa-stack fa-lg">
										<i class="fa fa-circle fa-stack-2x fa-green"></i>
										<i class="fa fa-file-o fa-stack-1x"></i>
										<i class="fa fa-blue fa-text-right fa-09x"> Beantwoorden</i>
										<i class="fa fa-pencil fa-stack-up-15p fa-blue fa-06x"> </i>
									  </span>',
										array('/openVragenAntwoorden/create',
											  'event_id'=>$obj->event_ID,
											  'group_id'=>$_GET['group_id'],
											  'vraag_id'=>$obj->open_vragen_ID))
			);
		} else {
			if (OpenVragenAntwoorden::model()->isActionAllowed('openVragenAntwoorden',
																'update',
																$obj->event_ID,
																"", //model_id
																$_GET['group_id']) &&
				OpenVragenAntwoorden::model()->isVraagGecontroleerd($obj->event_ID,
																	$_GET['group_id'],
																	$obj->open_vragen_ID) == 'Nee')
			{
				$vraagtData[] = array(
					'oneRow'=>true,
					'type'=>'raw',
					'value'=>Html::link('<span class="fa-stack fa-lg">
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
			'value'=>$obj->vraag
		);
		$vraagtData[] = array(
			'name'=>'Score',
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>$obj->score
		);
		$vraagtData[] = array(
			'name'=>'Beantwoord',
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>OpenVragenAntwoorden::model()->isVraagBeantwoord($obj->event_ID,
																		$_GET['group_id'],
																		$obj->open_vragen_ID)
		);
		$vraagtData[] = array(
			'name'=>'Gecontroleerd',
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>OpenVragenAntwoorden::model()->isVraagGecontroleerd($obj->event_ID,
																		$_GET['group_id'],
																		$obj->open_vragen_ID)
		);
		$vraagtData[] = array(
			'name'=>'Correct',
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>OpenVragenAntwoorden::model()->isVraagGoed($obj->event_ID,
																$_GET['group_id'],
																$obj->open_vragen_ID)
		);
	}
	if (!isset($vraagtData)){
		$vraagtData[] = array(
				'value'=>'Geen vragen voor vandaag',
				'oneRow'=>true);
	}
	$this->widget('ext.widgets.DetailView4Col', array(
		'data'=>$openVragenDataProvider,
		'attributes'=>$vraagtData,
	)); ?>