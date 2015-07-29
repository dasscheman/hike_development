<?php
// Created: 2014
// Modified: 22 feb 2015

/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Profiel'=>array('/game/viewUser'),
);
?>

<h1>Vrienden zoeken</h1>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'users-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'user_ID',
		'username',
		'voornaam',
		'achternaam',
		'email',
		'last_login_time',
		array(
			'header'=>'Uitnodigen',
			'class'=>'CButtonColumn',
			'template'=>'{connect}',
			'buttons'=>array
			(
				'connect' => array
				(
					'label'=>'
						<span class="fa-stack fa-lg">
							<i class="fa fa-check fa-stack-1x"></i>
						</span>',
                    'options'=>array('title'=>'Nodig uit om vrienden te worden.'),
					'url'=>'Yii::app()->createUrl("friendList/connect", array("user_id"=>$data->user_ID))',
				),
			),
		),
	),
)); ?>
