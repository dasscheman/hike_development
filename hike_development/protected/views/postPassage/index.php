<?php
// Created: 2014
// Modified: 26 jan 2015

/* @var $this PostPassageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Vorige'=>array($_GET['previous'],'event_id'=>$_GET['event_id']),
);
?>

<h1>Gepasserde Posten<sup><small>
				<?php echo CHtml::link('<i class="fa fa-question-circle fa-inverse"></i>',
				array('/site/help#PostPassages'),
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
                'header'=>Posten::model()->getAttributeLabel('post_name'),
				'name'=>'post_name',
				'value'=>'$data->post->post_name'
			),
			array(
                'header'=>Posten::model()->getAttributeLabel('date'),
				'name'=>'date',
				'value'=>'$data->post->date'
			),
			array(
                'header'=>$model->getAttributeLabel('gepasseerd'),
				'name'=>'gepasseerd',
                'class' => 'CCheckBoxColumn',
				'selectableRows'=>0,
				'checked'=>'$data->gepasseerd',
				'headerHtmlOptions'=>array('width'=>'3%'),
				'htmlOptions'=>array('style'=>'text-align:center'),
			),
			array(
                'header'=>$model->getAttributeLabel('binnenkomst'),
				'name'=>'binnenkomst',
				'value'=>'$data->binnenkomst'
			),
			array(
                'header'=>$model->getAttributeLabel('vertrek'),
				'name'=>'vertrek',
				'value'=>'$data->vertrek'
			),
			array(
                'header'=>$model->getAttributeLabel('score'),
				'name'=>'score',
				'value'=>'$data->post->score',
				'headerHtmlOptions'=>array('width'=>'3%'),
				'htmlOptions'=>array('style'=>'text-align:center'),
			),
			array(
                'header'=>Users::model()->getAttributeLabel('username'),
				'name'=>'username',
				'value'=>'$data->createUser->username'
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
                        'options'=>array('title'=>'Bewerken'),
                        'url'=>'Yii::app()->createUrl("/postPassage/updateVertrek", array(
                            "event_id"=>$data->event_ID,
                            "id"=>$data->posten_passage_ID,))',
                    ),
                ),
            ),
    )
));?>
