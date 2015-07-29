<?php
/* @var $this ChartController */
?>

<h1>Tussenstand</h1>

<p>
	Dit bevindt zich nog in experimentele fase. 
</p>
<?php
    $timestamp=CDateTimeParser::parse('05/09/2014 19:15:00','dd/MM/yyyy hh:mm:ss');
    $mintimestamp = $timestamp *1000;
	$this->Widget('ext.highcharts.HighchartsWidget',
		      array('options'=>array('chart' => array('type' => 'line'),
					     'credits' => array('enabled' => false),
					     'title' => array('text' => 'Tussenstand'),
					     'xAxis' => array('type' => 'datetime',
							              'dateTimeLabelFormats' => array('hour'=> '%A %H:%M',
											      'day'=>'%A %e %b',
											      'week'=>'%A %e %b',),
                                          'min'=>$mintimestamp),
					     'yAxis' => array('title' => array('text' => 'Totaal Score')),
					     'series' => $testarr,
					     'tooltip' => array('headerFormat'=>'<b>{series.name}</b><br>',
								'pointFormat'=>'{point.x:%A %e %b %Y %H:%M} - {point.y:.0f} punten'),
				
     )
   )
);
?>