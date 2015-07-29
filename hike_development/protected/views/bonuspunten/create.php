<?php
// Created: 2014
// Modified: 25 jan 2015

/* @var $this BonuspuntenController */
/* @var $model Bonuspunten */

?>

<h1>Bonuspunten Toekennen<sup><small>
							<?php echo CHtml::link('<i class="fa fa-question-circle fa-inverse"></i>',
							array('/site/help#BonuspuntenToekennen'),
							array('target'=>'_blank')); ?>
						</small></sup></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>