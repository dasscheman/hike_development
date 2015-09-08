<?php
// Created: 2014
// Modified: 20 feb 2015

/* @var $this GroupsController */
/* @var $dataProvider CActiveDataProvider */

$event_id = $_GET['event_id'];
$hikeStatus = EventNames::model()->getStatusHike($event_id);
$activeDay  = EventNames::model()->getActiveDayOfHike($event_id);

$this->menu=array(

	array('label'=>'<span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x fa-green"></i>
                                <i class="fa fa-file-o fa-stack-1x"></i>
                                <i class="fa fa-blue fa-text-right fa-07x"> Vragen Controleren</i>
                                <i class="fa fa-check fa-stack-5p fa-blue fa-05x"> </i>
                        </span>',
	      'url'=>array('openVragenAntwoorden/viewControle',
                'event_id'=>$event_id),
                'visible'=> OpenVragenAntwoorden::model()->isActionAllowed('openVragenAntwoorden', 'viewControle', $_GET['event_id'])
	),

	array('label'=>'<span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x fa-green"></i>
                                <i class="fa fa-sun-o fa-stack-1x"></i>
                                <i class="fa fa-blue fa-text-right fa-07x"> Bonuspunten Geven</i>
                                <i class="fa fa-plus fa-stack-3p fa-blue fa-04x"> </i>
                        </span>',
	      'url'=>array('bonuspunten/create',
                'event_id'=>$event_id),
                'visible'=> Bonuspunten::model()->isActionAllowed('bonuspunten', 'create', $_GET['event_id'])
	),

	array('label'=>'<span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x fa-green"></i>
                                <i class="fa fa-file-o fa-stack-1x"></i>
                                <i class="fa fa-blue fa-text-right fa-07x">Beantwoorden Vragen</i>
                                <i class="fa fa-list-ol fa-stack-5p fa-blue fa-05x"> </i>
                        </span>',
	      'url'=>array('openVragenAntwoorden/index',
                'event_id'=>$event_id,
                'previous'=>'game/gameOverview'),
                'visible'=> OpenVragenAntwoorden::model()->isActionAllowed('openVragenAntwoorden', 'index', $_GET['event_id'])
	),

	array('label'=>'<span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x fa-green"></i>
                                <i class="fa fa-dropbox fa-stack-1x"></i>
                                <i class="fa fa-blue fa-text-right fa-07x">Geopende Hints</i>
                                <i class="fa fa-lightbulb-o fa-stack-up-21p fa-blue fa-06x"> </i>
                        </span>',
	      'url'=>array('openNoodEnvelop/index',
                'event_id'=>$event_id,
                'previous'=>'game/gameOverview'),
                'visible'=> OpenNoodEnvelop::model()->isActionAllowed('openNoodEnvelop', 'index', $_GET['event_id'])
	),

	array('label'=>'<span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x fa-green"></i>
                                <i class="fa fa-sun-o fa-stack-1x"></i>
                                <i class="fa fa-blue fa-text-right fa-07x">Bonuspunten Overzicht</i>
                                <i class="fa fa-list-ol fa-stack-6p fa-blue fa-03x"> </i>
                        </span>',
	      'url'=>array('bonuspunten/index',
                'event_id'=>$event_id,
                'previous'=>'game/gameOverview'),
                'visible'=> Bonuspunten::model()->isActionAllowed('bonuspunten', 'index', $_GET['event_id'])
	),

	array('label'=>'<span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x fa-green"></i>
                                <i class="fa fa-flag-o fa-stack-1x"></i>
                                <i class="fa fa-blue fa-text-right fa-07x">Gepasserde Posten</i>
                                <i class="fa fa-list-ol fa-stack-2p fa-blue fa-03x"> </i>
                        </span>',
	      'url'=>array('postPassage/index',
                'event_id'=>$event_id,
                'previous'=>'game/gameOverview'),
                'visible'=> PostPassage::model()->isActionAllowed('postPassage', 'index', $_GET['event_id'])
	),

	array('label'=>'<span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x fa-green"></i>
                                <i class="fa fa-qrcode fa-stack-1x"></i>
                                <i class="fa fa-blue fa-text-right fa-07x">Stille Posten</i>
                                <i class="fa fa-check fa-stack-5p fa-blue fa-05x"> </i>
                        </span>',
	      'url'=>array('QrCheck/index',
                'event_id'=>$event_id,
                'previous'=>'game/gameOverview'),
                'visible'=> QrCheck::model()->isActionAllowed('qrCheck', 'index', $_GET['event_id'])
	),
        );
?>

<table>
    <tr>
        <td style="text-align:center;">
           <h2>Spel overzicht<sup><small>
                                <?php echo CHtml::link('<i class="fa fa-question-circle fa-inverse"></i>',
                                array('/site/help#SpelOverzicht'),
                                array('target'=>'_blank')); ?>
                             </small></sup>
           </h2>
        </td>
    </tr>

    <tr>
        <td style="text-align:center;font-family:verdana;font-size:17px;">
            <b> Status van Hike: </b> <?php echo EventNames::model()->getStatusText2($hikeStatus); ?>
       </td>
    </tr>
    <?php if ($hikeStatus == EventNames::STATUS_gestart) { ?>
    <tr>
        <td style="text-align:center;font-family:verdana;font-size:17px;">
            <b> Actieve dag: </b><?php echo $activeDay; ?>
        </td>
    </tr>
    <?php } ?>
</table>
<center>Dit is een overzicht van alle groepjes die meedoen. Het symbool <i class="fa fa-search-plus fa-inverse"></i>
betekent dat je daar meer details van je groep kan bekijken.

Je kunt zien wat de score is van een groepje voor een bepaald onderdeel, maar
je kunt niet precies zien welke vragen of hints deze groep heeft beantwoord of
open gemaakt. </center><br/>

<i> Als de Hike is afgelopen, dan kun je de resultaten van een ander groepje bekijken. </i><br/>
<?php $this->widget('zii.widgets.CListView',
		    array('dataProvider'=>$dataProvider,
			  'itemView'=>'_gameOverview',
			  'enablePagination' => false,
			  'summaryText'=>'',
			  'emptyText'=>'Er zijn nog geen groepen ingeschreven',

));
?>
