<?php
// Created: 2014
// Modified: 26 jan 2015

/* @var $this BonuspuntenController */
/* @var $dataProvider CActiveDataProvider */
if(isset($_GET['previous'])){
	$goto = $_GET['previous'];
} else {
	$goto = '/game/gameOverview';
}

    $this->breadcrumbs=array(
        'Vorige'=>array($goto,'event_id'=>$_GET['event_id']),
    );
?>

<h1>Bonuspunten Overzicht<sup><small>
				<?php echo CHtml::link('<i class="fa fa-question-circle fa-inverse"></i>',
				array('/site/help#Bonuspunten'),
				array('target'=>'_blank')); ?>
			   </small></sup></h1>

<?php 
  $this->widget('bootstrap.widgets.TbGridView', array(
        'id'=>'bonuspunten-grid',
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
                'header'=>Bonuspunten::model()->getAttributeLabel('date'),
				'name'=>'date',
				'value'=>'$data->date'
			),
			array(
                'header'=>Posten::model()->getAttributeLabel('post_name'),
				'name'=>'post_name',
				'value'=>'$data->post->post_name'
			),
			array(
                'header'=>$model->getAttributeLabel('omschrijving'),
				'name'=>'omschrijving',
				'value'=>'$data->omschrijving'
			),
			array(
                'header'=>Users::model()->getAttributeLabel('username'),
				'name'=>'username',
				'value'=>'$data->createUser->username'
			),
			array(
                'header'=>$model->getAttributeLabel('score'),
				'name'=>'score',
				'value'=>'$data->score',
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
                        'options'=>array('title'=>'Bewerken'),
                        'url'=>'Yii::app()->createUrl("/bonuspunten/update", array(
                            "event_id"=>$data->event_ID,
                            "group_id"=>$data->group_ID,
                            "id"=>$data->bouspunten_ID,))',
                    ),
                ),
            ),
    )
));?>