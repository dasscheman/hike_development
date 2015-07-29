<?php
// Created: 2014
// Modified: 23 feb 2015

/* @var $this GroupsController */
/* @var $dataProvider CActiveDataProvider */

$event_id   = $_GET['event_id'];
$hikeStatus = EventNames::model()->getStatusHike($event_id);
$activeDay  = EventNames::model()->getActiveDayOfHike($event_id);

$event_id = $_GET['event_id'];
$this->menu=array(	
    array(
		'label'=>'Introductie',
		'url'=>array(
			'/Route/viewIntroductie',
			'event_id'=>$_GET['event_id'],
			'introduction'=>true),
		'visible'=> Route::model()->isActionAllowed('route', 'viewIntroductie', $_GET['event_id'])),
    array(
		'label'=>'Route Beheren',
		'url'=>array(
			'/route/index',
			'event_id'=>$_GET['event_id']),
		'visible'=> Route::model()->isActionAllowed('route', 'index', $_GET['event_id'])),
    array(
		'label'=>'Posten Beheren',
		'url'=>array(
			'/posten/index',
			'event_id'=>$_GET['event_id']),
		'visible'=> Posten::model()->isActionAllowed('posten', 'index', $_GET['event_id'])),
    array(
		'label'=>'Vragen Overzicht',
		'url'=>array(
			'/openVragen/index',
			'event_id'=>$_GET['event_id']),
		'visible'=> OpenVragen::model()->isActionAllowed('openVragen', 'index', $_GET['event_id'])),
    array(
		'label'=>'Hints Overzicht',
		'url'=>array(
			'/noodEnvelop/index',
			'event_id'=>$_GET['event_id']),
		'visible'=> Qr::model()->isActionAllowed('noodEnvelop', 'index', $_GET['event_id'])),

    array(
		'label'=>'Stille Posten Overzicht',
		'url'=>array(
			'/qr/index',
			'event_id'=>$_GET['event_id']),
		'visible'=> Qr::model()->isActionAllowed('qr', 'index', $_GET['event_id'])),
	
    array(
		'label'=>'Deelnemers Toevoegen',
		'url'=>array(
			'/deelnemersEvent/create',
			'event_id'=>$_GET['event_id']),
		'visible'=> DeelnemersEvent::model()->isActionAllowed('deelnemersEvent', 'create', $_GET['event_id'])),
    array(
		'label'=>'Groep Aanmaken',
		'url'=>array(
			'/groups/create',
			'event_id'=>$_GET['event_id']),
		'visible'=> Groups::model()->isActionAllowed('groups', 'create', $_GET['event_id'])),

    array(
		'label'=>'Dag Veranderen',
		'url'=>array(
			'/eventNames/changeDay',
			'event_id'=>$_GET['event_id']),
		'visible'=> EventNames::model()->isActionAllowed('eventNames', 'changeDay', $_GET['event_id'])),
    array(
		'label'=>'Status Veranderen',
		'url'=>array(
			'/eventNames/changeStatus',
			'event_id'=>$_GET['event_id']),
		'visible'=> EventNames::model()->isActionAllowed('eventNames', 'changeStatus', $_GET['event_id'])),
);

?>
<h1>Hike uitzetten </h1>
<h2><?php echo EventNames::model()->getEventName($_GET['event_id'])?></h2>

<table>
    <tr>
		<td colspan="3" style="text-align:center;font-family:verdana;font-size:17px;">
			<b> Status van Hike: </b> <?php echo EventNames::model()->getStatusText2($hikeStatus);
			if ($hikeStatus == EventNames::STATUS_gestart){ ?>
				<b> Actieve dag: </b> <?php echo $activeDay;
			}?>
		</td>
    </tr>
	<tr>
		Dit is een overzicht van de hike. Links staan de groepen die ingeschreven staan. 
		Rechts de mensen die als organisatie of post ingeschreven staan.
		Via het menu kun je de hike uitzetten. 
		Belangrijk om te weten: niet alle opties zijn altijd beschikbaar. Welke opties beschikbaar zijn 
		hangt af van de status van de hike. Als de hike in status opstart staat, dan kun je bijvoorbeeld vragen en posten toevoegen.
		Maar als de status op introductie op gestart staat, dan kan je dat niet meer doen.
		
    <tr>
	<td>
	    <h4>Groepen</h4>

	</td>
	<td>
	    <h4>Organisatie</h4>
	</td>
    </tr>

    <tr>
	<td style="vertical-align:top">
	    <?php 
		echo "Groepen die ingeschreven staan";
		$this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$groupsDataProvider,
		'itemView'=>'/groups/_view',
		'enablePagination' => false,
		'summaryText'=>'', 
		'emptyText'=>'Er zijn nog geen groepen aangemaakt voor deze hike.',
	    ));?>
	    </br>
	</td>
	<td style="vertical-align:top">			
	    <?php
		echo "Deelnemers die als organisatie meedraaien";
		$this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$organisatieDataProvider,
		'itemView'=>'/deelnemersEvent/_view',
		'enablePagination' => false,
		'summaryText'=>'', 
		'emptyText'=>'Er zijn geen deelenemers ingeschreven als organisatie.',
	    ));?>
	    </br>
	</td>
    </tr>	
</table>