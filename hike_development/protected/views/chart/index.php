<?php
/* @var $this ChartController */
?>

<h1>Tussenstand</h1>

<p>
	Dit bevindt zich nog in experimentele fase. Dit is pas te zien als hike gestart is.
</p>

<?php 
    $this->widget('zii.widgets.CListView',
		  array('dataProvider'=>$deelnemersEventDataProvider,
			'itemView'=>'_overview',
			'enablePagination' => true,
			'summaryText'=>'',
			'emptyText'=>'Er zijn geen spellen waar je geregistreerd staat',
			)
		  ); ?>
