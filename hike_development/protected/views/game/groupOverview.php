<?php
/* @var $this PostPassageController */
/* @var $model PostPassage */

$this->breadcrumbs=array(
	'Spel Overzicht'=>array('/game/gameOverview','event_id'=>$_GET['event_id']),
);

$event_id = $_GET['event_id'];
$group_id = $_GET['group_id'];

$this->menu=array(

	array('label'=>'<span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x fa-green"></i>
                                <i class="fa fa-flag-o fa-stack-1x"></i>
                                <i class="fa fa-blue fa-text-right fa-07x">Binnenkomst Post</i>
                                <i class="fa fa-angle-double-down fa-stack-up-3p fa-blue fa-05x"> </i>
                        </span>',
	      'url'=>array('postPassage/create',
			   'event_id'=>$event_id,
			   'group_id'=>$group_id),
	      'visible'=> PostPassage::model()->isActionAllowed('postPassage', 'create', $event_id, "", $group_id)),

	array('label'=>'<span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x fa-green"></i>
                                <i class="fa fa-flag-o fa-stack-1x"></i>
                                <i class="fa fa-blue fa-text-right fa-07x">Dag start</i>
                                <i class="fa fa-angle-double-down fa-stack-up-3p fa-blue fa-05x"> </i>
                        </span>',
	      'url'=>array('postPassage/createDayStart',
			   'event_id'=>$event_id,
			   'group_id'=>$group_id),
	      'visible'=> PostPassage::model()->isActionAllowed('postPassage', 'createDayStart', $event_id, "", $group_id)),

	array('label'=>'<span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x fa-green"></i>
                                <i class="fa fa-file-o fa-stack-1x"></i>
                                <i class="fa fa-blue fa-text-right fa-07x">Vragen</i>
                                <i class="fa fa-question fa-stack-6p fa-05x fa-blue"> </i>
                        </span>',
	      'url'=>array('openVragen/viewPlayers',
			   'event_id'=>$event_id,
			   'group_id'=>$group_id),
	      'visible'=> OpenVragen::model()->isActionAllowed('openVragen', 'viewPlayers', $event_id, "", $group_id)),

	array('label'=>'<span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x fa-green"></i>
                                <i class="fa fa-file-o fa-stack-1x"></i>
                                <i class="fa fa-blue fa-text-right fa-07x"> Beantwoorde Vragen</i>
                                <i class="fa fa-list-ol fa-stack-8p fa-05x fa-blue"> </i>
                        </span>',
	      'url'=>array('openVragenAntwoorden/viewPlayers',
			   'event_id'=>$event_id,
			   'group_id'=>$group_id),
	      'visible'=> OpenVragenAntwoorden::model()->isActionAllowed('openVragenAntwoorden', 'viewPlayers',  $event_id, "",$group_id)),

	array('label'=>'<span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x fa-green"></i>
                                <i class="fa fa-dropbox fa-stack-1x"></i>
                                <i class="fa fa-blue fa-text-right fa-07x">Hints</i>
                                <i class="fa fa-question fa-stack-up-21p fa-06x fa-blue"> </i>
                        </span>',
	      'url'=>array('noodEnvelop/viewPlayers',
			   'event_id'=>$event_id,
			   'group_id'=>$group_id,
			   'set_message'=>false),
	      'visible'=> NoodEnvelop::model()->isActionAllowed('noodEnvelop', 'viewPlayers', $event_id, "", $group_id)),

	array('label'=>'<span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x fa-green"></i>
                                <i class="fa fa-sun-o fa-stack-1x"></i>
                                <i class="fa fa-blue fa-text-right fa-07x">Bonuspunten</i>
                                <i class="fa fa-list-ol fa-stack-5p fa-04x fa-blue"> </i>
                        </span>',
	      'url'=>array('bonuspunten/viewPlayers',
			   'event_id'=>$event_id,
			   'group_id'=>$group_id),
	      'visible'=> Bonuspunten::model()->isActionAllowed('bonuspunten', 'viewPlayers', $event_id, "", $group_id)),

	array('label'=>'<span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x fa-green"></i>
                                <i class="fa fa-qrcode fa-stack-1x"></i>
                                <i class="fa fa-blue fa-text-right fa-07x">Stille Posten</i>
                                <i class="fa fa-list-ol fa-stack-2p fa-05x fa-blue"> </i>
                        </span>',
	      'url'=>array('qrCheck/viewPlayers',
			   'event_id'=>$event_id,
			   'group_id'=>$group_id),
	      'visible'=> QrCheck::model()->isActionAllowed('qrCheck', 'viewPlayers', $event_id, "", $group_id)),
);

?>
<table>
    <tr>
        <td style="text-align:center;">
			<h2><?php echo Groups::model()->getGroupName($group_id) ?> </h2>
        </td>
	</td>
	<?php
		if (EventNames::model()->getStatusHike($event_id) == EventNames::STATUS_gestart) {
	   		if (PostPassage::model()->timeLeftToday($event_id, $group_id)) {?>
    <tr>
        <td style="text-align:center;font-family:verdana;font-size:17px;">
			<b> Tijd over vandaag (minuten): </b><?php echo PostPassage::model()->timeLeftToday($event_id, $group_id); ?>
		<?php } else { ?>
			<h4>Jullie tijd is voorbij, ga direct door naar het eindpunt. Je vindt de cooordinaten van het eindpunt bij de hints.</h4>
        </td>
    </tr>
	<?php }
	   	} ?>
	<tr>
        <td style="text-align:center;">
			<h3>Posten Overzicht
				<sup><small>
					<?php echo CHtml::link('<i class="fa fa-question-circle fa-inverse"></i>',
					array('/site/help#PostPassage'),
					array('target'=>'_blank')); ?>
				</small></sup>
			</h3>
        </td>
    </tr>
	<tr>
		<td style="text-align:center">Een lijstje met posten die jullie gepasseerd zijn</td>
	</tr>
</table>

<?php
	foreach($postPassageDataProvider->data as $obj){
		$postData[]['header']='Post naam: ' . Posten::model()->getPostName($obj->post_ID);
		if(PostPassage::model()->isActionAllowed('postPassage', 'updateVertrek', $obj->event_ID, $obj->posten_passage_ID, $group_id) and !$obj->vertrek)
		{
			$postData[] = array(
				'oneRow'=>true,
				'type'=>'raw',
				'value'=>CHtml::link('<span class="fa-stack fa-lg">
											<i class="fa fa-circle fa-stack-2x fa-green"></i>
											<i class="fa fa-flag-o fa-stack-1x"></i>
											<i class="fa fa-blue fa-text-right fa-09x">Vertrek Post</i>
											<i class="fa fa-angle-double-up fa-stack-up-15p fa-blue fa-06x"> </i>
										  </span>',
										array('postPassage/updateVertrek',
											  'id'=>$obj->posten_passage_ID,
											  'event_id'=>$obj->event_ID)),
			);
		}
		$postData[] = array(
			'name'=>'group',
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>Groups::model()->getGroupName($obj->group_ID)
		);
		$postData[] = array(
			'name'=>'Gepasseerd',
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>GeneralFunctions::getJaNeeText($obj->gepasseerd)
		);
		$postData[] = array(
			'name'=>'Binnenkomst',
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>$obj->binnenkomst
		);
		$postData[] = array(
			'name'=>'Vetrek',
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>$obj->vertrek
		);
		$postData[] = array(
			'name'=>'Ingecheckt door',
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>Users::model()->getUserName($obj->create_user_ID)
		);
		$postData[] = array(
			'name'=>'Laatst bijgewerkt',
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>Users::model()->getUserName($obj->update_user_ID)
		);
		$postData[] = array(
			'name'=>'score',
			'oneRow'=>true,
			'type'=>'raw',
			'value'=>Posten::model()->getPostScore($obj->post_ID)
		);
	}

	if (!isset($postData)){
		$postData[] = array(
				'value'=>'Nog geen post binnenkomst geregistreerd.',
				'oneRow'=>true);
	}
	$this->widget('ext.widgets.DetailView4Col', array(
		'data'=>$postPassageDataProvider,
		'attributes'=>$postData,
	)); ?>

	<h3>Te Controleren Vragen
		<sup><small>
			<?php echo CHtml::link('<i class="fa fa-question-circle fa-inverse"></i>',
			array('/site/help#TecontrolerenVragen'),
			array('target'=>'_blank')); ?>
		 </small></sup>
	</h3>
	<center> Een lijstje met vragen die jullie beantwoord hebben, maar nog niet
		gecontroleerd zijn door de organisatie. Zolang de vraag nog niet beantwoord
		is kan het antwoord aangepast worden. Daarna niet meer en de vraag zal dan
		ook uit dit lijstje verdwijnen.</center>

	<?php
	foreach($teControlerenOpenVragenDataProvider->data as $obj){
		$vraagData[]['header']='Vraag naam: ' . OpenVragen::model()->getOpenVragenName($obj->open_vragen_ID);
		if (OpenVragenAntwoorden::model()->isActionAllowed('openVragenAntwoorden',
												'update',
												$obj->event_ID,
												"",
												$obj->group_ID) &&
			OpenVragenAntwoorden::model()->isVraagGecontroleerd($obj->event_ID,
																$obj->group_ID,
																$obj->open_vragen_ID) == 'Nee')
		{
			$vraagData[] = array(
				'oneRow'=>true,
				'type'=>'raw',
				'value'=>CHtml::link('<span class="fa-stack fa-lg">
										<i class="fa fa-circle fa-stack-2x fa-green"></i>
										<i class="fa fa-file-o fa-stack-1x"></i>
										<i class="fa fa-blue fa-text-right fa-09x">Bewerken</i>
										<i class="fa fa-refresh fa-stack-up-15p fa-blue fa-06x"> </i>
								  </span>',
								  array('/openVragenAntwoorden/update',
										'event_id'=>$obj->event_ID,
										'group_id'=>$obj->group_ID,
										'vraag_id'=>$obj->open_vragen_ID)),
			);
		}
		$vraagData[] = array(
			'name'=>'Hike dag',
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>OpenVragen::model()->getVraagDag($obj->open_vragen_ID)
		);
		$vraagData[] = array(
			'name'=>'Route onderdeel',
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>OpenVragen::model()->getRouteOnderdeelVraag($obj->open_vragen_ID)
		);
		$vraagData[] = array(
			'name'=>'Vraag',
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>OpenVragen::model()->getOpenVraag($obj->open_vragen_ID)
		);
		$vraagData[] = array(
			'name'=>'Antwoord spelers',
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>$obj->antwoord_spelers
		);
		$vraagData[] = array(
			'name'=>'Gecontroleerd',
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>GeneralFunctions::getJaNeeText($obj->checked)
		);
		$vraagData[] = array(
			'name'=>'Beantwoord door',
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>Users::model()->getUserName($obj->create_user_ID)
		);
	}

	if (!isset($vraagData)){
		$vraagData[] = array(
				'value'=>'Geen vragen die nog gecontroleerd moeten worden.',
				'oneRow'=>true);
	}
	$this->widget('ext.widgets.DetailView4Col', array(
		'data'=>$teControlerenOpenVragenDataProvider,
		'attributes'=>$vraagData,
	)); ?>


	<h3>Geopende Hints
		<sup><small>
			<?php echo CHtml::link('<i class="fa fa-question-circle fa-inverse"></i>',
			array('/site/help#GeopendeHints'),
			array('target'=>'_blank')); ?>
		</small></sup>
	</h3>

	<center> Een lijstje met hints die jullie geopend hebben. </center>
	<?php
	foreach($openNoodEnvelopDataProvider->data as $obj){
		$hintData[]['header']='Hint naam: ' . NoodEnvelop::model()->getNoodEnvelopName($obj->nood_envelop_ID);
		if (OpenNoodEnvelop::model()->isActionAllowed('openNoodEnvelop',
													  'update',
													  $obj->event_ID))
		{
			$hintData[] = array(
				'oneRow'=>true,
				'type'=>'raw',
				'value'=>CHtml::link('<span class="fa-stack fa-lg">
							<i class="fa fa-pencil fa-stack-1x"></i>
							<i class="fa fa-blue fa-text-right fa-07x"> Wijzigen </i>
					  </span>',
					  array('openNoodEnvelop/update',
							'id'=>$obj->open_nood_envelop_ID,
							'event_id'=>$obj->event_ID,
							'group_id'=>$obj->group_ID))
			);
		}

		$hintData[] = array(
			'name'=>'Hike dag',
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>NoodEnvelop::model()->getEventDayOfEnvelop($obj->nood_envelop_ID)
		);
		$hintData[] = array(
			'name'=>'Route onderdeel',
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>NoodEnvelop::model()->getRouteNameOfEnvelopId($obj->nood_envelop_ID)
		);

		$hintData[] = array(
			'name'=>'Opmerkingen',
			'oneRow'=>true,
			'type'=>'raw',
			'value'=>NoodEnvelop::model()->getOpmerkingen($obj->nood_envelop_ID)
		);
		$hintData[] = array(
			'name'=>'Coordinaten',
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>NoodEnvelop::model()->getCoordinaten($obj->nood_envelop_ID)
		);
		$hintData[] = array(
			'name'=>'Geopend',
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>GeneralFunctions::getJaNeeText($obj->opened)
		);
		$hintData[] = array(
			'name'=>'Geopend door',
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>Users::model()->getUserName($obj->create_user_ID)
		);
		$hintData[] = array(
			'name'=>'Geopend om',
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>$obj->create_time
		);
		$hintData[] = array(
			'name'=>'Strafpunten',
			'oneRow'=>true,
			'type'=>'raw',
			'value'=>NoodEnvelop::model()->getNoodEnvelopScore($obj->nood_envelop_ID)
		);
	}
	if (!isset($hintData)){
		$hintData[] = array(
				'value'=>'Geen hints geopend',
				'oneRow'=>true);
	}
	$this->widget('ext.widgets.DetailView4Col', array(
		'data'=>$openNoodEnvelopDataProvider,
		'attributes'=>$hintData,
	)); ?>
