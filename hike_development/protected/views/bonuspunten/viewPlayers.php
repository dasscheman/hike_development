<?php
/* @var $this BonuspuntenController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Spel Overzicht'=>array('/game/gameOverview','event_id'=>$_GET['event_id']),
	'Groeps Overzicht'=>array('/game/groupOverview',
                                'event_id'=>$_GET['event_id'],
                                'group_id'=>$_GET['group_id']),
);
/*
$this->menu=array(
	array('label'=>'Create Bonuspunten', 'url'=>array('create')),
	array('label'=>'Manage Bonuspunten', 'url'=>array('admin')),
);*/
?>

<h1>Bonuspunten<sup><small>
							<?php echo CHtml::link('<i class="fa fa-question-circle fa-inverse"></i>',
							array('/site/help#Bonuspunten'),
							array('target'=>'_blank')); ?>
				 </small></sup></h1>

<?php
	foreach($bonuspuntenDataProvider->data as $obj){
		$bonuspuntenData[]['header']='Bonuspunten: ' . $obj->omschrijving;

		$bonuspuntenData[] = array(
			'name'=>$obj->getAttributeLabel('date'),
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>$obj->date
		);
		$bonuspuntenData[] = array(
			'name'=>$obj->getAttributeLabel('post'),
			'oneRow'=>false,
			'type'=>'raw',
			'value'=>Posten::model()->getPostName($obj->post_ID)
		);
		$bonuspuntenData[] = array(
			'name'=>$obj->getAttributeLabel('score'),
			'oneRow'=>true,
			'type'=>'raw',
			'value'=>$obj->score
		);
	}
	if (!isset($bonuspuntenData)){
		$bonuspuntenData[] = array(
				'value'=>'Geen vragen voor vandaag',
				'oneRow'=>true);
	}
	$this->widget('ext.widgets.DetailView4Col', array(
		'data'=>$bonuspuntenDataProvider,
		'attributes'=>$bonuspuntenData,
	)); ?>