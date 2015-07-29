<?php
/* @var $this NoodEnvelopController */
/* @var $model NoodEnvelop */

$this->breadcrumbs=array(
	'Startup Spel Overzicht'=>array('/startup/startupOverview','event_id'=>$_GET['event_id']),
        //'Noodenvelop Overzicht'=>array('/noodEnvelop/index','event_id'=>$_GET['event_id']),
);

?>

<h1>Hint maken</h1>

<?php echo $this->renderPartial('_formCreate', array('model'=>$model)); ?>