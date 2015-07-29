<?php
/* @var $this FriendListController */
/* @var $model FriendList */

$this->breadcrumbs=array(
	'Friend Lists'=>array('index'),
	$model->friend_list_ID=>array('view','id'=>$model->friend_list_ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List FriendList', 'url'=>array('index')),
	array('label'=>'Create FriendList', 'url'=>array('create')),
	array('label'=>'View FriendList', 'url'=>array('view', 'id'=>$model->friend_list_ID)),
	array('label'=>'Manage FriendList', 'url'=>array('admin')),
);
?>

<h1>Update FriendList <?php echo $model->friend_list_ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>