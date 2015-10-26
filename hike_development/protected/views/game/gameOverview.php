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
<center>Dit is een overzicht van alle groepjes die meedoen. Klik op <i class="fa fa-search-plus fa-inverse"></i>
om meer details van een groep te bekijken.
Momenteel kunnen deelnemers alleen het groepsoverzicht van hun eigen groep bekijken.
De organisatie kan wel alle groepsoverzichten bekijken. </center><br/>




<i> Je kunt de headers gebruiken om te zoeken naar een goepje of deelnemer. </i><br/>
<?php
	$this->widget('bootstrap.widgets.TbGridView', array(
        'id'=>'post-score-grid',
        'dataProvider'=>$model->searchScore($_GET['event_id']),
        'filter'=>$model,
        'columns'=>array(
			array(
               // 'header'=>Groups::model()->getAttributeLabel('group_name'),
				'name'=>'group_name',
				'value'=>'$data->group_name',
				'headerHtmlOptions'=>array('width'=>'10%'),
			),
			array(
              //  'header'=>Groups::model()->getAttributeLabel('group_members'),
				'name'=>'group_members',
				'value'=>'$data->group_members',
				'headerHtmlOptions'=>array('width'=>'10%'),
			),
			array(
                //'header'=>Groups::model()->getAttributeLabel('bonus_score'),
				'name'=>'bonus_score',
				'value'=>'$data->bonus_score',
				'headerHtmlOptions'=>array('width'=>'3%'), 
				'htmlOptions'=>array('style'=>'text-align:center'),
			),
			array(
               // 'header'=>Groups::model()->getAttributeLabel('posten_score'),
				'name'=>'post_score',
				'value'=>'$data->post_score',
				'headerHtmlOptions'=>array('width'=>'3%'),
				'htmlOptions'=>array('style'=>'text-align:center'),
			),
			array(
               // 'header'=>Groups::model()->getAttributeLabel('qr_score'),
				'name'=>'qr_score',
				'value'=>'$data->qr_score',
				'headerHtmlOptions'=>array('width'=>'3%'),
				'htmlOptions'=>array('style'=>'text-align:center'),
			),
			array(
               // 'header'=>Groups::model()->getAttributeLabel('vragen_score'),
				'name'=>'vragen_score',
				'value'=>'$data->vragen_score',
				'headerHtmlOptions'=>array('width'=>'3%'),
				'htmlOptions'=>array('style'=>'text-align:center'),
			),
			array(
               // 'header'=>Groups::model()->getAttributeLabel('hint_score'),
				'name'=>'hint_score',
				'value'=>'-$data->hint_score',
				'headerHtmlOptions'=>array('width'=>'3%'),
				'htmlOptions'=>array('style'=>'text-align:center'),
			),
			array(
              //  'header'=>Groups::model()->getAttributeLabel('totaal_score'),
				'name'=>'totaal_score',
				'value'=>'$data->totaal_score',
				'headerHtmlOptions'=>array('width'=>'3%'),
				'htmlOptions'=>array('style'=>'text-align:center'),
			),
			array(
               // 'header'=>Groups::model()->getAttributeLabel('rank'),
				'name'=>'rank',
                'type'=> 'raw',
				'filter'=>false,
				//'value'=>'$data->rank',
				'value'=>'Groups::model()->getRankGroup($data->event_ID, $data->group_ID)',
				'headerHtmlOptions'=>array('width'=>'3%'),
				'htmlOptions'=>array('style'=>'text-align:center'),
			),
            array(
                'header'=>'Optie',
                'class'=>'CButtonColumn',
				'headerHtmlOptions'=>array('width'=>'3%'),
				//'htmlOptions'=>array('width'=>'3%'),
                'template'=>'{details}',
                'buttons'=>array(
                    'details' => array(
                        'label'=>'<span class="fa-stack fa-lg">
                                    <i class="fa fa-search-plus fa-inverse"></i>
                                  </span>',
                        'options'=>array('title'=>'Bekijken'),
                        'url'=>'Yii::app()->createUrl("/game/groupOverview", array(
                            "event_id"=>$data->event_ID,
                            "group_id"=>$data->group_ID,))',
                    ),
                ),
            ),
    )
));


	$this->widget('bootstrap.widgets.TbGridView', array(
        'id'=>'post-passage-grid',
        'dataProvider'=>$modelPost->searchPost($_GET['event_id']),
        'filter'=>$modelPost,
        'columns'=>array(
			array(
               // 'header'=>Groups::model()->getAttributeLabel('group_name'),
				'name'=>'group_name',
				'value'=>'$data->group_name',
				'headerHtmlOptions'=>array('width'=>'5%'),
			),
			array(
              //  'header'=>Groups::model()->getAttributeLabel('group_members'),
				'name'=>'group_members',
				'value'=>'$data->group_members',
				'headerHtmlOptions'=>array('width'=>'5%'),
			),
			array(
               // 'header'=>Groups::model()->getAttributeLabel('vragen_score'),
				'name'=>'last_post',
				//'value'=>'$data->last_post',
				'value'=>'Posten::model()->getPostName(PostPassage::model()->getLaatstePostPassageNaam($data->event_ID, $data->group_ID))',
				'filter'=>false,
				'headerHtmlOptions'=>array('width'=>'4%'),
				'htmlOptions'=>array('style'=>'text-align:center'),
			),
			array(
               // 'header'=>Groups::model()->getAttributeLabel('hint_score'),
				'name'=>'last_post_time',
				//'value'=>'$data->last_post_time',
				'value'=>'PostPassage::model()->getLaatstePostPassageTijd($data->event_ID, $data->group_ID)',
				'filter'=>false,
				'headerHtmlOptions'=>array('width'=>'4%'),
				'htmlOptions'=>array('style'=>'text-align:center'),
			),

			array(
               // 'header'=>Groups::model()->getAttributeLabel('hint_score'),
				'name'=>'time_walking',
				'value'=>'PostPassage::model()->displayWalkingTime($data->event_ID, $data->group_ID)',
				'filter'=>false,
				'headerHtmlOptions'=>array('width'=>'4%'),
				'htmlOptions'=>array('style'=>'text-align:center'),
			),
			array(
               // 'header'=>Groups::model()->getAttributeLabel('hint_score'),
				'name'=>'time_left',
				'value'=>'PostPassage::model()->displayTimeLeft($data->event_ID, $data->group_ID)',
				'filter'=>false,
				'headerHtmlOptions'=>array('width'=>'4%'),
				'htmlOptions'=>array('style'=>'text-align:center'),
			),
    )
));

?>
