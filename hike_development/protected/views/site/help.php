<?php
/* @var $this SiteController */
/*
 */

?>
<h1>Help</h1>
<div id="Begin">
<ul>
    <li><b>
            <td colspan="4" style="text-align:center; font-size:220%">
						<span class="fa-stack fa-lg">
								  <i class="fa fa-circle fa-stack-1x fa-green fa-15x"></i>
								  <i class="fa fa-home fa-stack-1x"></i>
							        </span>					
				  </td></b> De beginpagina van de site. Als je ingelogd bent heb je hier de mogelijkheid om je wachtwoord te wijzigen. </li>
    <li><b>
            <td colspan="4" style="text-align:center; font-size:220%">
						<span class="fa-stack fa-lg">
								  <i class="fa fa-circle fa-stack-1x fa-green fa-15x"></i>
								  <i class="fa fa-compass fa-stack-1x"></i>
							        </span>					
				  </td></b> Hier staat een overzicht van de standen van de verschillende groepjes. Bij elke groepsnaam staat een plusje, als je bij die groep hoort, dan kan je via dat plusje naar je groepsgegevens.</li>
    <li><b>
            <td colspan="4" style="text-align:center; font-size:220%">
						<span class="fa-stack fa-lg">
								  <i class="fa fa-circle fa-stack-1x fa-green fa-15x"></i>
								  <i class="fa fa-bar-chart-o fa-stack-1x"></i>
							        </span>						
				  </td></b> De score in een fancysmancy grafiekje. </li>
    <li><b>
            <td colspan="4" style="text-align:center; font-size:220%">
						<span class="fa-stack fa-lg">
								  <i class="fa fa-circle fa-stack-1x fa-green fa-15x"></i>
								  <i class="fa fa-tachometer fa-stack-1x"></i>
							        </span>						
				  </td></b> Hier kan de organisatie het een en ander instellen en aanpassen.</li>	
    <li><b>
            <td colspan="4" style="text-align:center; font-size:220%">
						<span class="fa-stack fa-lg">
								  <i class="fa fa-circle fa-stack-1x fa-green fa-15x"></i>
								  <i class="fa fa-cogs fa-stack-1x"></i>
							        </span>						
				  </td></b> Dit is afgesloten.</li>
    <li><b>
            <td colspan="4" style="text-align:center; font-size:220%">
						<span class="fa-stack fa-lg">
								  <i class="fa fa-circle fa-stack-1x fa-green fa-15x"></i>
								  <i class="fa fa-envelope-o fa-stack-1x"></i>
							        </span>					
				  </td></b> Hier kan je een berichtje sturen naar de beheerder van de site. </li>
    <li><b>
            <td colspan="4" style="text-align:center; font-size:220%">
						<span class="fa-stack fa-lg">
								  <i class="fa fa-circle fa-stack-1x fa-green fa-15x"></i>
								  <i class="fa fa-unlock-alt fa-stack-1x"></i>
							       </span>					
				  </td>
        </b> Als je hierop klikt dan kan je inloggen. </li>
    <li><b>
            <td colspan="4" style="text-align:center; font-size:220%">
						<span class="fa-stack fa-lg">
								  <i class="fa fa-circle fa-stack-1x fa-green fa-15x"></i>
								  <i class="fa fa-child fa-stack-1x"></i>
								  <i class="fa fa-stack-60p fa-03x fa-blue">'.Yii::app()->user->name.'</i>
							       </span>					
				  </td>
        </b> Dit betekend dat je bent ingelogd en onder welke naam. </li>
</ul>
</br>
<div id="HikeOverzicht">
<p><h3>Hike Overzicht</h3>
Het is een overzicht van alle hiken waarvoor je ingeschreven bent.</p>
<p>Als je bent ingeschreven voor 1 hike of als er 1 hike de status
introdctie of gestart heeft, dan krijg je dit scherm niet te zien. </p>	

</br>
</br>

<div id="SpelOverzicht">
<p><h3>Spel Overzicht</h3>
Het is een overzicht van alle groepen die meedoen met de hike.
<ul>
    <li><b>Group Name:</b> Dit is de naam van de groep </li>
    <li><b>Post:</b> Dit is de post die deze groep als laatst is gepasseerd. </li>
    <li><b>Tijd Laatste Post:</b> Dit is het tijdstip van de laatste binnenkomst op een post</li>
    <li><b>Score Posten:</b> Totaal score voor het passeren van de posten. </li>
    <li><b>Score Vragen:</b> Totaal score voor het beantwoorden van de vragen.</li>
    <li><b>Score Stille Posten:</b> Totaal score voor het scannen van stille posten. </li>
    <li><b>Score Bonuspunten:</b> Totaal score voor bonuspunten.</li>	
    <li><b>Strafpunten Hints:</b> Totaal aantal strafpunten voor het openen van hint.</li>
    <li><b>Total score:</b> Totaal score. </li>
    <li><b>
            <td colspan="4" style="text-align:center; font-size:220%"">
						<span class="fa-stack fa-lg">
							  <i class="fa fa-circle fa-stack-2x fa-gold"></i>
							  <i class="fa fa-trophy fa-stack-1x fa-inverse"></i>
							  <i class="fa fa-stack-30p fa-blue fa-05x"> 1 </i>
						</span>						
				  </td>
        </b> De ranking voor deze groep. </li>
</ul>
</br>


<div id="AntwoordenControleren">
<h3>Antwoorden Controleren</h3>
Hier kan de organisatie de vragen beoordelen. 
<ul>
    <li><b>Goed (figuur):</b> Antwoord is fout. </li>
    <li><b>Four (figuur):</b> Antwoord is goed en groep krijgt de punten voor deze vraag.</li>
</ul>
</p>
</br>
</br>

<div id="Vragen">
<h3>Alle Vragen</h3>
Hier staat een overzicht van alle vragen die een groep kan beantwoorden. 
<ul>
   
</ul>
</p>
</br>
</br>


<div id="BeantwoordeVragen">
<h3>Beantwoorde Vragen</h3>
Hier staat een overzicht van alle vragen die een groep heeft beantwoorden. 
<ul>
   
</ul>
</p>
</br>
</br>




<div id="TeControlerenVragen">
<h3>Te Controleren Vragen</h3>
Hier staan vragen die nog gecontroleerd moeten worden. Zolang de vragen nog niet gecontroleerd zijn,
kunnen de antwoorden nog aangepast worden.
<ul>
    
</ul>
</p>
</br>
</br>

<div id="BonuspuntenToekennen">
<h3>Bonuspunten Toekennen</h3>
Hier kan de organisatie de bonuspunten geven aan een groep. Dit kunnen ook strafpunten zijn (negetieve getallen). 
<ul>

</ul>
</p>
</br>
</br>

<div id="Hints">
<h3>Hints</h3>
Dit is een overzicht van alle hints die beschikbaar zijn en die een groep kan openen. LET OP!
Bij het openen van een hint krijgt je groep strafpunten. 
<ul>

</ul>
</p>
</br>
</br>

<div id="BeantwoordeVragen">
<h3>Beantwoorde Vragen</h3>
Dit is een overzicht van vragen die een groep beantwoord heeft.
<ul>

</ul>
</p>
</br>
</br>

<div id="GeopendeHints">
<h3>Geopende Hints</h3>
Dit is een overzicht van hints die een groep geopend heeft.
<ul>

</ul>
</p>
</br>
</br>


<div id="Bonuspunten">
<h3>Bonuspunten Overzicht</h3>
Dit is een overzicht van alle bonuspunten die toegekend zijn.
Tijdens een hike kan alleen de organisatie dit overzicht bekijken.
Als een hike beeindigd is, dan kunnen alle deelnemers dit overzicht
ook bekijken en hun scores vergelijken.
<ul>

</ul>
</p>
</br>
</br>


<div id="PostPassages">
<h3>Gepasseerde Posten</h3>
Dit is een overzicht van alle Posten die gepasseerd zijn.
Tijdens een hike kan alleen de organisatie dit overzicht bekijken.
Als een hike beeindigd is, dan kunnen alle deelnemers dit overzicht
ook bekijken en hun scores vergelijken.
<ul>

</ul>
</p>
</br>
</br>


<div id="BinnenkomstPost">
<h3>Binnenkomst Posten Registreren</h3>
Hier kan de organisatie of iemand van de post de binnenkomst van een groep registreren.
<ul>

</ul>
</p>
</br>
</br>

<div id="StillePosten">
<h3>Stille Posten</h3>
Dit is een overzicht van alle stille posten die gepasseerd zijn.
Tijdens een hike kan alleen de organisatie dit overzicht bekijken.
Als een hike beeindigd is, dan kunnen alle deelnemers dit overzicht
ook bekijken en hun scores vergelijken.
<ul>

</ul>
</p>
</br>
</br>



</br>
</br>