<?php
/* @var $this GameController */

?>
<br>
<h1>Hike Overzicht <?php echo CHtml::link(TbHtml::icon(TbHtml::ICON_QUESTION_SIGN),
					  array('/site/help#HikeOverzicht'),
					  array('target'=>'_blank')); ?> </h1> 

Dit is een overzicht van alle Hikes waarvoor je bent ingeschreven.
<?php 
    $this->widget('zii.widgets.CListView',
		  array('dataProvider'=>$deelnemersEventDataProvider,
			'itemView'=>'_overview',
			'enablePagination' => true,
			'summaryText'=>'',
			'emptyText'=>'Er zijn geen spellen waar je geregistreerd staat',
			)
		  ); ?>