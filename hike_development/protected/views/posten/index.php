<?php
// Created: 2014
// Modified: 11 jan 2015

/* @var $this PostenController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Startup Spel Overzicht'=>array('/startup/startupOverview','event_id'=>$_GET['event_id']),
);

$this->menu=array(
    array('label'=>'Post Maken',
	      'url'=>array(
                'create',
                'event_id'=>$_GET['event_id'])),
);
?>

<h1>Overzcht van posten</h1>
<h3>
	Je kunt hier de volgorde van de posten wijzigen.
</h3>
<p> 
	Maak voor elke dag een aantal posten aan. .
	De score is het aantal punten dat een groep krijgt als ze die posten binnenkomen. <br>
	BELANGRIJK!!<br>
	Je moet voor elke dag ook een start en eind post maken. Deze zijn nodig om de totale looptijd te berekenen. 
	De score voor de startpost word niet meegenomen, een groep krijgt punten als ze een post binnenkomen.

</p>
<?php
   	$activeTab = Posten::model()->getDefaultActiveTab($startDate);
		
	if (Posten::model()->isActionAllowed("posten", "create", $_GET['event_id'])) { 
		$newButton = CHtml::link(
                '<span class="fa-stack fa-lg">
                    <td style="text-align:right;">
                        <i class="fa fa-plus fa-stack-1x">Nieuw</i>
                    </td>
				</span>',
                    $this->createAbsoluteUrl(
                        'create',
                        array('event_id'=>$_GET['event_id'],
                            'date'=>$startDate)));
	} else {
		$newButton = '';
	}

	$count=0;
	while($startDate <= $endDate) {
		// dit moet nog een vervangen worden door javascript.
		//Met de volgende code wordt de active tab onthouden. 		
		$active=false;
		if (isset($activeTab))
		{
			if ($activeTab==$startDate)
				$active=true;
		}
		else
		{
			if ($count==0)
				$active=true;
		}
		
	    $dataArray[$count]=array(
		    'label' =>$startDate,
		    'active'=>$active,
		    'content' =>$newButton
            .$this->widget(
		    	'bootstrap.widgets.TbGridView',
				array(
					'id'=>'post-grid',
					'dataProvider'=>$postenData->searchPostDate($_GET['event_id'], $startDate),
					'columns'=>array(
                        'post_name',
                        'date',
                        'score',
                        'post_volgorde',
						array(
							'header'=>'Opties',
							'class'=>'CButtonColumn',
							'template'=>'{details}{omhoog}{omlaag}',
							'buttons'=>array(
								'details' => array(
									'label'=>'<span class="fa-stack fa-lg">
												<i class="fa fa-search fa-stack-1x"></i>
											  </span>',
									'options'=>array('title'=>'Bekijk deze hike'),
									'url'=>'Yii::app()->createUrl("posten/view", array(
										"post_id"=>$dataz->post_ID,
										"event_id"=>$data->event_ID,))',
								),
								'omhoog' => array(
									'label'=>'<span class="fa-stack fa-lg">
										<i class="fa fa-level-up fa-stack-1x"></i>
										</span>',
									'options'=>array('title'=>'Schuif omhoog'),
									'url'=>'Yii::app()->createUrl("/posten/moveUpDown", array(
										"event_id"=>$data->event_ID,
										"date"=>$data->date,
										"up_down"=>"up",
										"post_id"=>$data->post_ID,
										"volgorde"=>$data->post_volgorde))',
                                    'visible'=>'Posten::model()->isActionAllowed(
										"posten", 
										"moveUpDown", 
                                        $data->event_ID,
										"",
                                        $data->date,
                                        $data->post_volgorde,
										"up")',
								),
								'omlaag' => array(
									'label'=>'<span class="fa-stack fa-lg">
										<i class="fa fa-level-down fa-stack-1x"></i>
										</span>',
									'options'=>array('title'=>'Schuif omlaag'),
									'url'=>'Yii::app()->createUrl("/posten/moveUpDown", array(
										"event_id"=>$data->event_ID,
										"date"=>$data->date,
										"up_down"=>"down",
										"post_id"=>$data->post_ID,
										"volgorde"=>$data->post_volgorde))',
                                    'visible'=>'Posten::model()->isActionAllowed(
										"posten",
										"moveUpDown",
                                        $data->event_ID,
										"",
                                        $data->date,
                                        $data->post_volgorde,
										"down")',
								),
							),
						),
			    ),
			),
			true
		    ),
		//),
	    );

		$startDate = date('Y-m-d', strtotime($startDate. ' + 1 days'));
	    $count++;
		// more then 10 days is unlikly, therefore break.
		if ($count == 10) {
			break;
		}
	} 



$this->widget('bootstrap.widgets.TbTabs', array(
	'tabs'=>$dataArray
    )
);

/*   $this->widget('bootstrap.widgets.TbGridView',
    array(
        'id'=>'posten-grid',
        'dataProvider'=>$data->searchPosten($_GET['event_id']),
        //'filter'=>$postenData,
        'columns'=>array(
			'post_name',
            'date',
            'score',
            'post_volgorde',
            array(
                'header'=>'Opties',
                'class'=>'CButtonColumn',
                'template'=>'{details}{omhoog}{omlaag}{verwijderen}',
                'buttons'=>array(
                    'details' => array(
                        'label'=>'<span class="fa-stack fa-lg">
                                    <i class="fa fa-search fa-stack-1x"></i>
                                  </span>',
                        'options'=>array('title'=>'Bekijk deze hike'),
                        'url'=>'Yii::app()->createUrl("posten/view", array(
                            "post_id"=>$data->post_ID,
                            "event_id"=>$data->event_ID,))',
                    ),
                   'omhoog' => array(
                        'label'=>'<span class="fa-stack fa-lg">
                            <i class="fa fa-level-up fa-stack-1x"></i>
                            </span>',
                        'options'=>array('title'=>'Schuif omhoog'),
                        'url'=>'Yii::app()->createUrl("/posten/moveUpDownPost", array(
                            "event_id"=>$data->event_ID,
                            "date"=>$data->date,
                            "up_down"=>"up",
                            "post_id"=>$data->post_ID,
                            "volgorde"=>$data->post_volgorde))',
                        'visible'=>'Posten::model()->isActionAllowed(
                                        "post",
                                        "moveUp",
                                        $data->event_ID,
                                        $data->date,
                                        $data->post_volgorde)',
                    ),
                    'omlaag' => array(
                        'label'=>'<span class="fa-stack fa-lg">
                            <i class="fa fa-level-down fa-stack-1x"></i>
                            </span>',
                        'options'=>array('title'=>'Schuif omlaag'),
                        'url'=>'Yii::app()->createUrl("/posten/moveUpDownPost", array(
                            "event_id"=>$data->event_ID,
                            "date"=>$data->date,
                            "up_down"=>"down",
                            "post_id"=>$data->post_ID,
                            "volgorde"=>$data->post_volgorde))',
                        'visible'=>'Posten::model()->isActionAllowed(
                                        "post",
                                        "moveDown",
                                        $data->event_ID,
                                        $data->date,
                                        $data->post_volgorde)',
                    ),
                    'verwijderen' => array(
                        'label'=>'<span class="fa-stack fa-lg">
                            <i class="fa fa-times fa-stack-1x"></i>
                            </span>',
                        'options'=>array(
                            'title'=>'Verwijderen',
                            'confirm' => 'Weet je zeker dat je deze post wilt verwijderen?',),
                        'url'=>'Yii::app()->createUrl("posten/delete", array(
                            "event_id"=>$data->event_ID,
                            "post_id"=>$data->post_ID))',
                        'visible'=>'Posten::model()->isActionAllowed("posten", "delete", $data->event_ID)',
                    ),
                ),
            ),
    )
));*/ 
?>
