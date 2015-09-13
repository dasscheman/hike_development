<?php
/* @var $this DeelnemersEventController */
/* @var $model DeelnemersEvent */

$this->breadcrumbs=array(
	'Spel Overzicht'=>array('/game/gameOverview','event_id'=>$_GET['event_id']),
);

$this->menu=array(
	array('label' => 'Post Actie'),
	array('label'=>'Binnenkomst registreren',
          'url'=>array('/postPassage/create', 
                       'event_id'=>$_GET['event_id'], 
                       'user_id'=>$_GET['user_id'])),
        //TbHtml::menuDivider(),
	array('label'=>'Posten', 'url'=>array('/postPassage/index')), 
	array('label'=>'Vragen', 'url'=>array('/openVragenAntwoorden/index')),
	array('label'=>'Bonuspunten', 'url'=>array('/bonuspunten/index')), 
    );

?>


<h1>Hike Overzicht </h1>
<h1>Gepasseerde Posten </h1>
<?php $this->widget('zii.widgets.CListView',
		    array('dataProvider'=>$postPassageDataProvider,
			  'itemView'=>'/postPassage/_view',
			  'enablePagination' => true,
			  'summaryText'=>'',
			  'emptyText'=>'Er zijn nog geen route onderdelen aangemaakt voor deze hike.',
			  )); ?>