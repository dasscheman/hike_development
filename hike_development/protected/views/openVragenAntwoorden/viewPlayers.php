<?php
/* @var $this OpenVragenController */
/* @var $model OpenVragen */

$this->breadcrumbs=array(
	'Spel Overzicht'=>array('/game/gameOverview','event_id'=>$_GET['event_id']),
	'Groeps Overzicht'=>array('/game/groupOverview',
                                'event_id'=>$_GET['event_id'],
                                'group_id'=>$_GET['group_id'])
);

?>
	
	<h2>Beantwoorde Vragen <sup><small>
										<?php echo CHtml::link('<i class="fa fa-question-circle fa-inverse"></i>',
										array('/site/help#BeantwoordeVragen'),
										array('target'=>'_blank')); ?>
					                 </small></sup></h2>	
			<?php $this->widget('zii.widgets.CListView', array(
				'dataProvider'=> $openVragenAntwoordenDataProvider,//new CActiveDataProvider('OpenVragen'),
				'itemView'=>'/openVragenAntwoorden/_viewPlayers',
				'enablePagination' => false,
				'summaryText'=>'', 
				'emptyText'=>'Er zijn geen vragen beantwoord',
)); ?>
