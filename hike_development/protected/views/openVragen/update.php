<?php
// Created: 2015
// Modified: 11 jan 2015

/* @var $this OpenVragenController */
/* @var $model OpenVragen */

$this->breadcrumbs=array(
	'Startup Spel Overzicht'=>array('/startup/startupOverview','event_id'=>$model->event_ID),
/* TODO: Deze wordt aangeroepen vanuit route beheer en vanuit introductie.
 * Vanaf introductie is de link niet helemaal goed.
 */
    'Route Overzicht'=>array('/route/view','route_id'=>$model->route_ID,'event_id'=>$model->event_ID),

);

?>

<h1>Vraag <?php echo $model->open_vragen_name; ?> bijwerken</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>