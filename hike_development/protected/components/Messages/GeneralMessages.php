<?php

class GeneralMessages
{
    public static function HikeNotSet()
    {
        // Er is geen event geselecteerd, dus geen toegang:
        throw new CHttpException(403,"Er is geen hike geselecteerd.");
    }

    public static function HikeStatusNotSet()
    {
        // Er is geen event geselecteerd, dus geen toegang:
        throw new CHttpException(403,"Hike heeft geen status.");
    }
   
    public static function HintNotSet()
    {
        // Er is geen event geselecteerd, dus geen toegang:
        throw new CHttpException(403,"Er is geen hint geselecteerd.");
    }
   
    public static function HintIsUsed()
    {
        // Er is geen event geselecteerd, dus geen toegang:
        throw new CHttpException(403,"Deze hint is al in geopend door een groep.");
    }
    
    public static function RolOfPlayerNotSet()
    {
        throw new CHttpException(403,"Er is voor jou geen rol geselecteerd, neem contact op met de organisatie.");
    }
    
    public static function GroupNotSet()
    {
        // Er is geen groep geselecteerd, dus geen toegang:
        throw new CHttpException(403,"Er is geen groep geselecteerd.");
    }
     
	public static function NietDeBedoeling()
	{
		throw new CHttpException(403,"Dat is eigenlijk niet de bedoeling.");
	}

	public static function GeenDagActief()
	{
		throw new CHttpException(403,"Er is geen dag actief.");
	}
	
	public static function QrCodeNotSet()
	{
		throw new CHttpException(403,"QR niet gezet.");
	}
	
	public static function QrCodeUsed()
	{
		throw new CHttpException(403,"QR is al gebruikt.");
	}
	
    public static function OrderNumberDoesNotExist()
	{
		throw new CHttpException(403,"Volgorde nummer bestaat niet.");
	}

	public static function VraagIsGecontroleerd()
	{
		throw new CHttpException(403,"Deze vraag is al gecontroleerd.");			
	}
	
	public static function NoAccesToGroup($actieVoorGroep, $userVanGroep)
    {
            /** Je hebt geen toegang tot deze groep, dus geen toegang:
    * $actieVoorGroep = is de groep waarvoor een actie gedaan wordt.
    * $userVanGroep = Is de groep waarvoor de huidige ingelogde gebruiker
    * is ingeschreven.
    */
    $group1 = Groups::model()->getGroupName($actieVoorGroep);
    $group2 = Groups::model()->getGroupName($userVanGroep);
            throw new CHttpException(403,"Je probeert een actie te doen voor groep " .$group1.
                     ", maar jij bent ingeschreven voor groep ".$group2);
    }
    
    public static function RolOfPlayerNotAllowed($event_id, $huidigeRol, $verwachteRol)
    {
    /**
     * Zet de exception message.
     * Als niet 1 duidig is welke rol gewenst is, dan input $verwachteRol
     * op 99 zetten.
     */
    $hikeNaam = EventNames::model()->getEventName($event_id);
    $huidigeRolText = DeelnemersEvent::model()->getRolText($huidigeRol);	
    if($verwachteRol <> 99)
    {
        $verwachteRolText = DeelnemersEvent::model()->getRolText($verwachteRol);
        throw new CHttpException(403, "Voor hike " .$hikeNaam.
                          " ben jij een " .$huidigeRolText.
                          ". Je moet een " . $verwachteRolText.
                          " zijn om deze actie te kunnen doen.");
        return;
    }
    
    throw new CHttpException(403, "Voor hike " .$hikeNaam.
                      " ben jij een " .$huidigeRolText.
                      ". Daarom kun jij deze actie niet doen.");
    }
    
    public static function HikeStatusNotAllowed($event_id, $huidigeStatus, $verwachteStatus)
    {
    /**
     * Zet de exception message.
     * Als niet 1 duidig is welke status gewenst is, dan input $verwachteStatus
     * op 99 zetten.
     */
    $hikeNaam = EventNames::model()->getEventName($event_id);
    $huidigeStatusText = EventNames::model()->getStatusText2($huidigeStatus);   
    if($verwachteStatus <> 99)
    {
        $verwachteStatusText = EventNames::model()->getStatusText2($verwachteStatus);
        throw new CHttpException(403, "Hike " .$hikeNaam.
                          " heeft status " .$huidigeStatusText.
                          " en dat moet zijn " . $verwachteStatusText);
        return;
    }
    
            throw new CHttpException(403, "Hike " .$hikeNaam.
                      " heeft status " .$huidigeStatusText);
    }
}