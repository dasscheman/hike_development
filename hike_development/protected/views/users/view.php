<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Admin Panel'=>array('admin/index'),
	'Gebruikers'=>array('users/index'),
);

$this->menu=array(
	array('label'=>'Nieuw Wachtwoord', 
	      'url'=>'#',
	      'linkOptions'=>array('submit'=>array('resendPasswordUser',
						   'id'=>$model->user_ID),
				   'confirm'=>'Weet je zeker dat je voor deze gebruiker een nieuw wachtwoord wilt versturen?')),
	array('label'=>'Gebruiker toevoegen', 'url'=>array('create')),
	array('label'=>'Gebruiker bewerken', 'url'=>array('update', 'id'=>$model->user_ID)),
	array('label'=>'Gebruiker verwijderen',
	      'url'=>'#',
	      'linkOptions'=>array('submit'=>array('delete',
						   'id'=>$model->user_ID),
				   'confirm'=>'Weet je zeker dat je deze gebruiker wilt verwijderen?')),
	array('label'=>'Gebruikers beheren', 'url'=>array('admin')),
);
?>

<h1>Gegevens van gebruiker <?php echo $model->username; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'user_ID',
		'username',
		'voornaam',
		'achternaam',
		'email',
		/*'password',
		'macadres',*/
		'birthdate',
		'last_login_time',
		/*'create_time',
		'create_user_ID',*/
		'update_time',
		'update_user_ID',
	),
)); ?>
