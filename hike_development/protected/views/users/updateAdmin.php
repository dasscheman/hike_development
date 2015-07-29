<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Profiel'=>array('/game/viewUser'),
);

$this->menu=array(
	array('label'=>'Nieuw Wachtwoord', 
	      'url'=>'#',
	      'linkOptions'=>array('submit'=>array('resendPasswordUser',
						   'id'=>$model->user_ID),
				   'confirm'=>'Weet je zeker dat je voor deze gebruiker een nieuw wachtwoord wilt versturen?')),
	array('label'=>'Gebruiker toevoegen', 'url'=>array('create')),
	array('label'=>'Gebruikers beheren', 'url'=>array('admin')),
	array('label'=>'Gebruiker verwijderen',
	      'url'=>'#',
	      'linkOptions'=>array('submit'=>array('delete',
						   'id'=>$model->user_ID),
				   'confirm'=>'Weet je zeker dat je deze gebruiker wilt verwijderen?')),
);
?>

<h1>Gebruiker <?php echo $model->username; ?> bijwerken</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>