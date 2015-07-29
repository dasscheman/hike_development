<?php

/**
 * AccesFunctions bevat enkele functies die de rechten checked
 * Er is geprobeerd om de functies zo generiek mogelijk op te zetten
 */
class AccesFunctions
{
        /**
	 * De eerste input is een array met rollen die toegestaan zijn.
	 * De tweede input is de event waarvoor gechecked moet worden.
	 * Als gebruiker voor dat event, 1 van de input rollen heeft, dan
	 * return true, anders false.
	 */
	/*public function checkAccesRolInEventToAction($user_rols, $event_id)
	{
		if(GeneralFunctions::UserIsAdmin())
			return true;
		    
		if(!isset($event_id))
		{
			// Er is geen event geselecteerd, dus geen toegang:
			throw new CHttpException(403,"Er is geen hike geselecteerd.");
			return(false);
		}
		
		$data = DeelnemersEvent::model()->find('event_ID = :event_id AND user_ID=:user_id', 
								    array(':event_id' => $event_id, 
									  ':user_id' => Yii::app()->user->id)); 
		if(!isset($data->rol))
		{
			/**
			 * Voor gebruiker is geen rol vastgesteld
			 * en heeft dus geen toegang tot event
			 */
	/*		throw new CHttpException(403,"Er is voor jou geen rol geselecteerd, neem contact op met de organisatie.");
			return(false);
		}
		
		foreach($user_rols as $user_rol)
		{ 	
			if($user_rol == $data->rol)
			{
				/**
				 * Rol van gebruiker komt overeen met 1 van de input rollen.
				 */
	/*			return(true);
			};
		}
		throw new CHttpException(403,"Je hebt niet de juiste rol voor deze actie.");
		return(false);
	}
	
	/*************************************************************************
	 * Functies die toegang tot de groepsinformatie controleren.
	 * View is alleen het bekijken van functies, Update is het veranderen van
	 * gegevens.
	 */
	
	/*public function checkAccesToViewGroupInformation($event_id, $group_id)
	{
	    	if(GeneralFunctions::UserIsAdmin())
			return true;
	    
	    		    
		if(!isset($event_id))
		{
			// Er is geen event geselecteerd, dus geen toegang:
			throw new CHttpException(403,"Er is geen hike geselecteerd.");
			return(false);
		}
		
		if(!isset($group_id))
		{
			// Er is geen groep geselecteerd, dus geen toegang:
			throw new CHttpException(403,"Er is geen groep geselecteerd.");
			return(false);
		}
	    
		$data = DeelnemersEvent::model()->find('event_ID = :event_id AND user_ID=:user_id',
							array(':event_id' => $event_id,
							      ':user_id' => Yii::app()->user->id)); 	
		/**
		 * Alleen voor deeelnemers moet gecontroleerd worden of de deelnemer is
		 * ingeschreven voor een bepaalde groep.
		 * Alle andere rollen hebben toegang tot groepsinformatie
		 */
	/*	if($data->rol <> 2 )
		{
			return(true);
		};
		    
		if($group_id <> $data->group_ID)
		{
			// Je hebt geen toegang tot deze groep, dus geen toegang:
			throw new CHttpException(403,"Je hebt geen toegang tot deze groep.");
			return(false);
		};
		return(true);
	}

    	public function checkAccesToUpdateGroupInformation($event_id, $group_id)
	{		    
		if(!isset($event_id))
		{
			// Er is geen event geselecteerd, dus geen toegang:
			throw new CHttpException(403,"Er is geen hike geselecteerd.");
			return(false);
		}
		
		if(!isset($group_id))
		{
			// Er is geen groep geselecteerd, dus geen toegang:
			throw new CHttpException(403,"Er is geen groep geselecteerd.");
			return(false);
		}
	    
		$data = DeelnemersEvent::model()->find('event_ID = :event_id AND user_ID=:user_id',
							array(':event_id' => $event_id,
							      ':user_id' => Yii::app()->user->id)); 	
		/**
		 * Alleen voor deeelnemers moet gecontroleerd worden of de deelnemer is
		 * ingeschreven voor een bepaalde groep.
		 */
	/*	if(!isset($data->rol))
		{
			// Er is aan het account voor deze hike geen rol toegekend, dus geen toegang:
			throw new CHttpException(403,"Er is aan je account geen rol toegekend.");
			return(false);
		}
		    
		if($data->rol <> 2)
		{
			// Aan dit account is voor deze hike niet de juiste rol toegekend, dus geen toegang:
			throw new CHttpException(403,"Je hebt niet de juiste rol voor deze actie.");
			return(false);
		}
		    
		if($group_id <> $data->group_ID)
		{
			// Je hebt geen toegang tot deze groep, dus geen toegang:
			throw new CHttpException(403,"Je hebt geen toegang tot deze groep.");
			return(false);
		};
		return(true);
	}

    	public function checkAccesToActionForOrganization($event_id)
	{		    
		if(!isset($event_id))
		{
			// Er is geen event geselecteerd, dus geen toegang:
			throw new CHttpException(403,"Er is geen hike geselecteerd.");
			return(false);
		}	    
	    
		$data = DeelnemersEvent::model()->find('event_ID = :event_id AND user_ID=:user_id',
							array(':event_id' => $event_id,
							      ':user_id' => Yii::app()->user->id)); 	
		/**
		 * Gebruikers met rol organisatie zijn toegestaan.
		 */
	/*	if(!isset($data->rol))
		{
			// Er is aan het account voor deze hike geen rol toegekend, dus geen toegang:
			throw new CHttpException(403,"Er is aan je account geen rol toegekend.");
			return(false);
		}
		    
		if($data->rol == 0)
		{
			return(true);
		};
		
		// Aan dit account is voor deze hike niet de juiste rol toegekend, dus geen toegang:
		throw new CHttpException(403,"Je hebt niet de juiste rol voor deze actie.");
		return(false);
		
	}


    
}