<?php
// Created: 2014
// Modified: 26 jan 2015

/* @var $this OpenVragenAntwoordenController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Vorige'=>array($_GET['previous'],'event_id'=>$_GET['event_id']),
);
?>

<h1>Alle beantwoorde vragen<sup><small>
							<?php echo CHtml::link('<i class="fa fa-question-circle fa-inverse"></i>',
							array('/site/help#BeantwoordeVragen'),
							array('target'=>'_blank')); ?>
						</small></sup></h1>

<?php 
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id'=>'open-vragen-grid',
        'dataProvider'=>$model->searchAnswered($_GET['event_id']),
        'filter'=>$model,
        'columns'=>array(
			array(
                'header'=>Groups::model()->getAttributeLabel('group_name'),
				'name'=>'group_name',
				'value'=>'$data->group->group_name',
				'headerHtmlOptions'=>array('width'=>'10%'),
			),
			/*array(
                'header'=>OpenVragen::model()->getAttributeLabel('open_vragen_name'),
				'name'=>'open_vragen_name',
				'value'=>'$data->openVragen->open_vragen_name'
			),*/
			array(
                'header'=>OpenVragen::model()->getAttributeLabel('vraag'),
				'name'=>'open_vraag',
				'value'=>'$data->openVragen->vraag'
			),
			array(
                'header'=>$model->getAttributeLabel('antwoord_spelers'),
				'name'=>'antwoord_spelers',
				'value'=>'$data->antwoord_spelers'
			),
			array(
                'header'=>OpenVragen::model()->getAttributeLabel('goede_antwoord'),
				'name'=>'goede_antwoord',
				'value'=>'$data->openVragen->goede_antwoord'
			),
			array(
                'header'=>$model->getAttributeLabel('checked'),
				'name'=>'checked',
                'class' => 'CCheckBoxColumn',
				'selectableRows'=>0,
				'checked'=>'$data->checked',
				'headerHtmlOptions'=>array('width'=>'3%'),
				'htmlOptions'=>array('style'=>'text-align:center'),
			),
			array(
                'header'=>$model->getAttributeLabel('correct'),
				'name'=>'correct',
                'class' => 'CCheckBoxColumn',
				'selectableRows'=>0,
				'checked'=>'$data->correct',
				'headerHtmlOptions'=>array('width'=>'3%'),
				'htmlOptions'=>array('style'=>'text-align:center'),
			),
			array(
                'header'=>Users::model()->getAttributeLabel('username'),
				'name'=>'username',
				'value'=>'$data->createUser->username'
			),
			array(
                'header'=>OpenVragen::model()->getAttributeLabel('score'),
				'name'=>'score',
				'value'=>'$data->openVragen->score',
				'headerHtmlOptions'=>array('width'=>'3%'),
				'htmlOptions'=>array('style'=>'text-align:center'),
			),
			'create_time',
            array(
                'header'=>'Bewerken',
                'class'=>'CButtonColumn',
                'template'=>'{details}',
                'buttons'=>array(
                    'details' => array(
                        'label'=>'<span class="fa-stack fa-lg">
                                    <i class="fa fa-search fa-stack-1x"></i>
                                  </span>',
                        'options'=>array('title'=>'Bekijk dit antwoord'),
                        'url'=>'Yii::app()->createUrl("/openVragenAntwoorden/updateOrganisatie", array(
                            "event_id"=>$data->event_ID,
                            "group_id"=>$data->group_ID,
                            "vraag_id"=>$data->open_vragen_ID,))',
						'visible'=>'OpenVragenAntwoorden::model()->isActionAllowed(
							"openVragenAntwoorden",
							"update",
							$data->event_ID,
							$data->open_vragen_ID,
							$data->group_ID)'
                    ),
                ),
            ),
    )
));

?>


