<?php
// Created: 2014
// Modified: 21 feb 2015

/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
?>
 
<h1>Welkom <?php echo Yii::app()->user->name; ?> bij de <i>
<?php echo CHtml::encode(Yii::app()->name); ?></i></h1>
<?php
$this->menu=array(	
    array('label'=>'<span class="fa-stack fa-lg">
                <i class="fa fa-circle fa-stack-1x fa-green fa-15x"></i>
                <i class="fa fa-unlock-alt fa-stack-1x"></i>
                <i class="fa fa-blue fa-text-right fa-07x"> Inloggen</i>
            </span>',
        'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
    array('label'=>'<span class="fa-stack fa-lg">
                <i class="fa fa-circle fa-stack-1x fa-green fa-15x"></i>
                <i class="fa fa-child fa-stack-1x"></i>
                <i class="fa fa-blue fa-text-right fa-07x"> Uitloggen '.Yii::app()->user->name.'</i>
            </span>',
        'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
    array('label'=>'<span class="fa-stack fa-lg">
                <i class="fa fa-circle fa-stack-1x fa-green fa-15x"></i>
                <i class="fa fa-unlock-alt fa-stack-1x"></i>
                <i class="fa fa-blue fa-text-right fa-07x">Account Maken</i>
            </span>',
        'url'=>array('/users/create'), 'visible'=>Yii::app()->user->isGuest),
    array('label'=>'<span class="fa-stack fa-lg">
                <i class="fa fa-circle fa-stack-1x fa-green fa-15x"></i>
                <i class="fa fa-unlock-alt fa-stack-1x"></i>
                <i class="fa fa-blue fa-text-right fa-07x">Wachtwoord vergeten</i>
            </span>',
        'url'=>array('/users/resendPasswordUser'), 'visible'=>Yii::app()->user->isGuest),
);
?>
<p>Dit is de nieuwe Hike-APP<i>-beta</i>. Dat <i>-beta</i> betekend dat hij eigenlijk nog niet af, maar wel bruikbaaar. </br>
Er staan nog een hoop verbeteringen en aanvulling op de planning. Dus opmerkingen en aanvullingen </br>
zijn welkom en kunnen bij contact ingevuld worden.</br>
</p>
	<h2>Korte uitleg</h2> 
    Hoewel de helppagina verre van compleet is, staat er toch het een en ander uitgelegd dat handig zou kunnen zijn.   
    Je kunt naar de help gaan door op dit icoontje te klikken:  
    <?php echo CHtml::link('<i class="fa fa-question-circle fa-inverse"></i>',
    array('/site/help#Begin'),
    array('target'=>'_blank')); ?> <br/><br/>

  

