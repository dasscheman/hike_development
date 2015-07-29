<?php
/* @var $this QrCheckController */
/* @var $dataProvider CActiveDataProvider */


$this->breadcrumbs=array(
	'Spel Overzicht'=>array('/game/gameOverview','event_id'=>$_GET['event_id']),
	'Groeps Overzicht'=>array('/game/groupOverview',
                                'event_id'=>$_GET['event_id'],
                                'group_id'=>$_GET['group_id'])
);

?>

<h1>Stille Posten<sup><small>
					<?php echo CHtml::link('<i class="fa fa-question-circle fa-inverse"></i>',
					array('/site/help#StillePosten'),
					array('target'=>'_blank')); ?>
		 </small></sup></h1>

<center> Een lijstje met stille posten die jullie gepasseerd zijn </center>
<?php $this->widget('zii.widgets.CListView',
		    array('dataProvider'=>$qrCheckDataProvider,
			  'itemView'=>'_viewPlayers',
			  'enablePagination' => false,
			  'summaryText'=>'',
			  'emptyText'=>'Je hebt nog geen enkele stille post gecheckt.',
)); ?>
