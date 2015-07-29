<?php
/* @var $this SiteController */
/* @var $error array */
/*
$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);*/
?>
<h1> Dat mag dus niet...</h1>
<h2>Error <?php echo $code; ?></h2>

<div class="error">
<?php echo CHtml::encode($message); ?>
</div>