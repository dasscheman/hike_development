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
	
	<h2>Alle Vragen <sup><small>
										<?php echo CHtml::link('<i class="fa fa-question-circle fa-inverse"></i>',
										array('/site/help#Vragen'),
										array('target'=>'_blank')); ?>
					                 </small></sup></h2>
<center> Hier een lijst met vragen. Als je en vraag beantwoordt, dan zal die in 
	 redelijk korte termijn gecontroleerd worden door de organisatie. En als een 
	 vraag eenmaal gecontroleerd is, dan kan je hem niet meer wijzigen. Dus 
     beantwoord ook alleen vragen als je werkelijk het antwoord denkt te weten. </center>	
		
<i> Je ziet alleen de vragen van vandaag. Dus op zaterdag kan je niet alsnog vragen invullen voor vrijdag!</i>
			<?php $this->widget('zii.widgets.CListView', array(
				'dataProvider'=> $openVragenDataProvider,//new CActiveDataProvider('OpenVragen'),
				'itemView'=>'/openVragen/_viewPlayers',
				'enablePagination' => false,
				'summaryText'=>'', 
				'emptyText'=>'Er zijn geen vragen',
)); ?>
