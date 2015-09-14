<?php
// Created: 2014
// Modified: 21 feb 2015

/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
?>
 
<h1>Welkom bij de <i>
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
<p>
	<h4>Organisatie</h4> 
	Als je regelmatig een hike organiseert dan komt het volgende waarschijnlijk bekent voor:
	Je zit uren op een post, hebt geen idee waar de deelnemers zijn en of ze een beetje goed lopen.
	En als de hike is afgelopen moet je allemaal kladpapiertjes ontcijferen met binnenkomsttijden van posten
	of de antwoorden van vragen die de deelnemers onderweg gemaakt hebben. 

	Met deze Hike-app is dat verleden tijd. Het registeren van binnenkomst of vertrek van een post zijn een
	paar klikken. Het controleren van de vragen gaat ook met 1 klik. Het bijhouden van de score van
	stille posten is voor de organisatie, tijdens de hike, helemaal geen werk meer.	
</p>
<p>
	<h4>Deelnemers</h4> 
	Je bent een weekend aan het hiken door een bos, vooraf heeft de organisatie je belooft
	dat je punten kunt scoren voor snelheid, het vinden van stille posten en beantwoorden van vragen.
	Maar hoeveel punten je precies krijgt hoor je pas aan het eind van de hike bij de prijsuitrijking.
	Dan blijkt dat als je toch nog even een klein stapje harder had gelopen, dat je dan net 1 of 2 plaatsen
	hoger was gekomen. Maar je had geen idee van je score, laat staan van de score van je directe concurenten.
	
	Met deze Hike-app kun je realtime je score zien, maar ook de score van je tegenstanders.
	Hierdoor kun je je strategie bepalen en wordt de hike nog spannender.
</p>

	<h4>Korte uitleg</h4> 
    Hoewel de helppagina verre van compleet is, staat er toch het een en ander uitgelegd dat handig zou kunnen zijn.   
    Je kunt naar de help gaan door op dit icoontje te klikken:  
    <?php echo CHtml::link('<i class="fa fa-question-circle fa-inverse"></i>',
    array('/site/help#faq'),
    array('target'=>'_blank')); ?> <br/><br/>

  

