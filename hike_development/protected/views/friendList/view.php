<?php
/* @var $this FriendListController */
/* @var $model FriendList */

$this->breadcrumbs=array(
	'Friend Lists'=>array('index'),
	$model->friend_list_ID,
);

$this->menu=array(
	array('label'=>'List FriendList', 'url'=>array('index')),
	array('label'=>'Create FriendList', 'url'=>array('create')),
	array('label'=>'Update FriendList', 'url'=>array('update', 'id'=>$model->friend_list_ID)),
	array('label'=>'Delete FriendList', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->friend_list_ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FriendList', 'url'=>array('admin')),
);
?>

<h1>View FriendList #<?php echo $model->friend_list_ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'friend_list_ID',
		'user_ID',
		'friends_with_user_ID',
		'status',
		'create_time',
		'create_user_ID',
		'update_time',
		'update_user_ID',
	),
)); ?>
