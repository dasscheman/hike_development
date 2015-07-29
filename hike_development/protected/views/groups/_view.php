<?php
/* @var $this GroupsController */
/* @var $data Groups */
// Created: 2014
// Last modified: 19 jan 2015
?>

<div class="view">
	<b><?php echo CHtml::encode($data->getAttributeLabel('group_name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->group_name), array(	'/groups/update',
																	'event_id'=>$data->event_ID,
																	'id'=>$data->group_ID)); ?>
	<br />
	<?php

	$printSeparator = false;
	foreach ($data->deelnemersEvents as $test )
	{
		if ($printSeparator)
			echo " - ";
		echo CHtml::encode(Users::model()->getUserName($test->user_ID));
		$printSeparator = true;
	}?>
</div>