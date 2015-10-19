<?php
// Created: 2014
// Modified: 26 jan 2015

/* @var $this QrCheckController */
/* @var $dataProvider CActiveDataProvider */


$this->breadcrumbs=array(
	'Vorige'=>array($_GET['previous'],'event_id'=>$_GET['event_id']),
);

?>

<h1>Stille Posten<sup><small>
				<?php echo CHtml::link('<i class="fa fa-question-circle fa-inverse"></i>',
				array('/site/help#StillePosten'),
				array('target'=>'_blank')); ?>
			   </small></sup></h1>

<?php
  $this->widget('bootstrap.widgets.TbGridView', array(
        'id'=>'post-passage-grid',
        'dataProvider'=>$model->search($_GET['event_id']),
        'filter'=>$model,
        'columns'=>array(
			array(
                'header'=>Groups::model()->getAttributeLabel('group_name'),
				'name'=>'group_name',
				'value'=>'$data->group->group_name',
				'headerHtmlOptions'=>array('width'=>'10%'),
			),
			array(
                'header'=>Qr::model()->getAttributeLabel('qr_name'),
				'name'=>'qr_name',
				'value'=>'$data->qr->qr_name'
			),
			array(
                'header'=>$model->getAttributeLabel('score'),
				'name'=>'score',
				'value'=>'$data->qr->score',
				'headerHtmlOptions'=>array('width'=>'3%'),
				'htmlOptions'=>array('style'=>'text-align:center'),
			),
			array(
                'header'=>Users::model()->getAttributeLabel('username'),
				'name'=>'username',
				'value'=>'$data->createUser->username'
			),
			'create_time',
          /*  array(
                'header'=>'Bewerken',
                'class'=>'CButtonColumn',
                'template'=>'{details}',
                'buttons'=>array(
                    'details' => array(
                        'label'=>'<span class="fa-stack fa-lg">
                                    <i class="fa fa-search fa-stack-1x"></i>
                                  </span>',
                        'options'=>array('title'=>'Bewerken'),
                        'url'=>'Yii::app()->createUrl("/qrCheck/update", array(
                            "event_id"=>$data->event_ID,
                            "group_id"=>$data->group_ID,
                            "id"=>$data->qr_check_ID,))',
						'visible'=>'QrCheck::model()->isActionAllowed(
							"qrCheck",
							"update",
							$data->event_ID,
							$data->qr_check_ID,
							$data->group_ID)'
                    ),
                ),
            ),*/
    )
));?>