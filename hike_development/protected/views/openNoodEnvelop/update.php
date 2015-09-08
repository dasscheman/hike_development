<?php
/* @var $this OpenNoodEnvelopController */
/* @var $model OpenNoodEnvelop */
/*
$this->breadcrumbs=array(
        'Vorige'=>array($_GET['previous'],'event_id'=>$_GET['event_id']),
);

$this->menu=array(
        array('label'=>'Delete OpenNoodEnvelop',
              'url'=>'#',
              'linkOptions'=>array('submit'=>array('delete',
                                                   'id'=>$model->open_nood_envelop_ID),
                                   'confirm'=>'Weet je zeker dat je deze geopende hint wilt verwijderen?')),
	
);*/
?>

<h1>Score geopende hint bijwerken voor groep <?php echo Groups::model()->getGroupName($model->group_ID); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>