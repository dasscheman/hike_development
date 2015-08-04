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
                                <i class="fa fa-blue fa-text-right fa-07x"> Binnenkomst Post</i>
                                <i class="fa fa-angle-double-down fa-stack-up-3p fa-blue fa-05x"> </i>
                        </span>',
	      'url'=>array('postPassage/create',
			   'event_id'=>$event_id,
			   'group_id'=>$group_id),
	      'visible'=> PostPassage::model()->isActionAllowed('postPassage', 'create', $event_id, $group_id)),
	
	array('label'=>'<span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x fa-green"></i>
                                <i class="fa fa-file-o fa-stack-1x"></i>
                                <i class="fa fa-blue fa-text-right fa-07x">Vragen</i>
                                <i class="fa fa-question fa-stack-6p fa-05x fa-blue"> </i>
                        </span>', 
	      'url'=>array('openVragen/viewPlayers',
			   'event_id'=>$event_id,
			   'group_id'=>$group_id),
	      'visible'=> OpenVragen::model()->isActionAllowed('openVragen', 'viewPlayers', $event_id, $group_id)),
	
	array('label'=>'<span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x fa-green"></i>
                                <i class="fa fa-file-o fa-stack-1x"></i>
                                <i class="fa fa-blue fa-text-right fa-07x"> Beantwoorde Vragen</i>
                                <i class="fa fa-list-ol fa-stack-8p fa-05x fa-blue"> </i>
                        </span>', 
	      'url'=>array('openVragenAntwoorden/viewPlayers',
			   'event_id'=>$event_id,
			   'group_id'=>$group_id),
	      'visible'=> OpenVragenAntwoorden::model()->isActionAllowed('openVragenAntwoorden', 'viewPlayers', $event_id, $group_id)),
	
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
	      'visible'=> NoodEnvelop::model()->isActionAllowed('noodEnvelop', 'viewPlayers', $event_id, $group_id)),
	
	array('label'=>'<span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x fa-green"></i>
                                <i class="fa fa-sun-o fa-stack-1x"></i>
                                <i class="fa fa-blue fa-text-right fa-07x">Bonuspunten</i>
                                <i class="fa fa-list-ol fa-stack-5p fa-04x fa-blue"> </i>
                        </span>',
	      'url'=>array('bonuspunten/viewPlayers',
			   'event_id'=>$event_id,
			   'group_id'=>$group_id),
	      'visible'=> Bonuspunten::model()->isActionAllowed('bonuspunten', 'viewPlayers', $event_id)),
	
	array('label'=>'<span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x fa-green"></i>
                                <i class="fa fa-qrcode fa-stack-1x"></i>
                                <i class="fa fa-blue fa-text-right fa-07x">Stille Posten</i>
                                <i class="fa fa-list-ol fa-stack-2p fa-05x fa-blue"> </i>
                        </span>',
	      'url'=>array('QrCheck/viewPlayers',
			   'event_id'=>$event_id,
			   'group_id'=>$group_id),
	      'visible'=> QrCheck::model()->isActionAllowed('qrCheck', 'viewPlayers', $event_id, $group_id)),
); 
   
?>
<table>
    <tr>
        <td style="text-align:center;">
			<h2>Posten Overzicht <sup><small>
								<?php echo CHtml::link('<i class="fa fa-question-circle fa-inverse"></i>',
								array('/site/help#PostPassage'),
								array('target'=>'_blank')); ?>
						 </small></sup></h2>
        </td>		    
    </tr>
	<?php 
		if (EventNames::model()->getStatusHike($event_id) == EventNames::STATUS_gestart) {
	   		if (PostPassage::model()->timeLeftToday($event_id, $group_id)) {?>
    <tr>
        <td style="text-align:center;font-family:verdana;font-size:17px;">
			<b> Tijd over vandaag: </b><?php echo PostPassage::model()->timeLeftToday($event_id, $group_id); ?>
		<?php } else { ?>
			<h3>Jullie tijd is voorbij, ga direct door naar het eindpunt. Je vindt de cooordinaten van het eindpunt bij de hints.</h3>
        </td>
    </tr>
	<?php }
	   	} ?>
	<tr>
		<td style="text-align:center">Een lijstje met posten die jullie gepasseerd zijn</td>
	</tr>
</table>

			<?php $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$postPassageDataProvider,
				'itemView'=>'/postPassage/_view',
				'enablePagination' => false,
				'summaryText'=>'', 
				'emptyText'=>'Jullie zijn nog geen posten gepasseerd',
			)); ?>
		
	<h2>Te Controleren Vragen  <sup><small>
										<?php echo CHtml::link('<i class="fa fa-question-circle fa-inverse"></i>',
										array('/site/help#TecontrolerenVragen'),
										array('target'=>'_blank')); ?>
							 </small></sup></h2>	
<center> Een lijstje met vragen die jullie beantwoord hebben, maar nog niet 	
	gecontroleerd zijn door de organisatie. Zolang de vraag nog niet beantwoord 	
	is kan het antwoord aangepast worden. Daarna niet meer en de vraag zal dan	
	ook uit dit lijstje verdwijnen.</center>
			<?php $this->widget('zii.widgets.CListView', array(
				'dataProvider'=> $teControlerenOpenVragenDataProvider,//new CActiveDataProvider('OpenVragen'),
				'itemView'=>'/openVragenAntwoorden/_viewPlayers',
				'enablePagination' => false,
				'summaryText'=>'', 
				'emptyText'=>'Er zijn geen vragen',
			));?>

<!--	
	<h2>Bonuspunten Overzicht <?/*php echo CHtml::link(TbHtml::icon(TbHtml::ICON_QUESTION_SIGN),
					  array('/site/help#ScoreOverzicht'),
					  array('target'=>'_blank')); ?></h2>
		
			<?php $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$bonusPuntenDataProvider,
				'itemView'=>'/bonuspunten/_view',
				'enablePagination' => false,
				'summaryText'=>'', 
				'emptyText'=>'Jullie hebben nog geen bounspunten gekregen.',
			)); */?>
-->
	<h2>Geopende Hints <sup><small>
										<?php echo CHtml::link('<i class="fa fa-question-circle fa-inverse"></i>',
										array('/site/help#GeopendeHints'),
										array('target'=>'_blank')); ?>
							 </small></sup></h2>
	<center> Een lijstje met hints die jullie geopend hebben. </center>
			<?php $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$openNoodEnvelopDataProvider,
				'itemView'=>'/openNoodEnvelop/_view',
				'enablePagination' => false,
				'summaryText'=>'', 
				'emptyText'=>'Jullie hebben nog geen hints geopend.',
			)); ?>


