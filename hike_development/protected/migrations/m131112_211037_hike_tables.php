<?php
// Created: 2014
// Modified: 2 jan 2015

class m131112_211037_hike_tables extends CDbMigration
{
    public function safeUp()
    {
/*****************************************************************************/
/* In alle tabellen komen de kolommen create_time, create_user_name,
/* update_time en update_user_name voor. Dit is om wijzigingen te kunnen 
/* bijhouden.                  
/*****************************************************************************/

/*****************************************************************************/
/* In de tabel Users bevat enkel de minimale gegevens van een gebruiker. Het 
/* wordt voorlopig niet de bedoeling dat mensen zelf wijzigingen kunnen 
/* aanbrengen. Inloggen kan worden gebruikt om vragen en opdrachten in te 
/* voeren, scores te bekijken of andere spel gegevens in te voeren. Dit is  
/* afhankelijk van de rol die een user heeft. Die rol is in de 
/* tbl_deelnemers_event tabel gedefineerd. 
/*****************************************************************************/

	$this->createTable(
	    'tbl_users',
	    array(
			'user_ID'           => 'int(11) NOT NULL AUTO_INCREMENT',
			'username'          => 'string NOT NULL',
			'voornaam'          => 'string NOT NULL',
			'achternaam'        => 'string NOT NULL',
			'email'             => 'string NOT NULL',
			'password'          => 'string NOT NULL',
			'macadres'          => 'string DEFAULT NULL',
			'birthdate'         => 'date DEFAULT NULL',
			'last_login_time'   => 'datetime DEFAULT NULL',
			'create_time'	=> 'datetime DEFAULT NULL',
			'create_user_ID'    => 'int(11) DEFAULT NULL',
			'update_time'       => 'datetime DEFAULT NULL',
			'update_user_ID'    => 'int(11) DEFAULT NULL',
			'PRIMARY KEY(`user_ID`)',
			'UNIQUE KEY(`username`)',
			'UNIQUE KEY(`email`)',), 
	    'ENGINE=InnoDB');

/*********************** table event_names ***********************************/
/*****************************************************************************/
/* De tabel tbl_events bevat alle hike georganiseerd. Elk event heeft een 
/* startdatum een einddatum en een status. de status kan zijn: opstart, gestart, 
/* beindigd, geannuleerd. 
/*****************************************************************************/
                                           
	$this->createTable(
	    'tbl_event_names',                                       
	    array(
			'event_ID'          => 'int(11) NOT NULL AUTO_INCREMENT',
			'event_name'        => 'string NOT NULL',
			'start_date'        => 'date DEFAULT NULL',
			'end_date'         	=> 'date DEFAULT NULL',
			'status'            => 'int(11) DEFAULT NULL',
			'active_day' 	=> 'int(11) DEFAULT NULL',
			'create_time'       => 'datetime DEFAULT NULL',
			'create_user_ID'	=> 'int(11) DEFAULT NULL',
			'update_time'       => 'datetime DEFAULT NULL',
			'update_user_ID'    => 'int(11) DEFAULT NULL',
			'PRIMARY KEY(`event_ID`)',
			'UNIQUE KEY(`event_name`)',),                                       
	    'ENGINE=InnoDB');                                      
                     
/*****************************************************************************/
/* add foreignkays
/*****************************************************************************/

	$this->addForeignKey("fk_events_create_user_name", 
			     "tbl_event_names", 
			     "create_user_ID",
			     "tbl_users", 
			     "user_ID", 
			     "RESTRICT", 
			     "CASCADE");
	$this->addForeignKey("fk_events_update_user_name", 
			     "tbl_event_names", 
			     "update_user_ID",
			     "tbl_users", 
			     "user_ID", 
			     "RESTRICT", 
			     "CASCADE"); 
 

/*****************************************************************************/
/* Route
/* In deze tabel staat de route voor een hike. Voor elke dag van een hike kunnen
/* route onderdelen aan gemaakt worden. De datum refereerd niet perse naar de
/* begin en eind datum gedefinieerd in de eventname tabel. Er kunnen namelijk
/* ook route onderdelen voor en na de hike aangemaakt worden. Dit is vooral om
/* de mogelijkheid om introductie vragen, posten en stille posten te ondersteunen. 
/*****************************************************************************/

	$this->createTable(
	    'tbl_route',
	    array(    
			'route_ID'	=> 'int(11) NOT NULL AUTO_INCREMENT',
			'route_name'	=> 'varchar(255) NOT NULL',
			'event_ID'	=> 'int(11) NOT NULL',
			'day_date'	=> 'date NOT NULL',
			'route_volgorde'=> 'int(11) DEFAULT NULL',
			'create_time'	=> 'datetime DEFAULT NULL',
			'create_user_ID'=> 'int(11) DEFAULT NULL',
			'update_time'	=> 'datetime DEFAULT NULL',
			'update_user_ID'=> 'int(11) DEFAULT NULL',
			'PRIMARY KEY (`route_ID`)',
			'UNIQUE KEY `event_ID` (`event_ID`,`day_date`,`route_name`)',),
	    'ENGINE=InnoDB');


	$this->addForeignKey("fk_route_event_id", 
			     "tbl_route", 
			     "event_ID",
			     "tbl_event_names", 
			     "event_ID", 
			     "RESTRICT", 
			     "CASCADE");

	$this->addForeignKey("fk_route_create_user_name", 
			     "tbl_route", 
			     "create_user_ID",
			     "tbl_users", 
			     "user_ID", 
			     "RESTRICT", 
			     "CASCADE");
	
	$this->addForeignKey("fk_route_update_user_name", 
			     "tbl_route", 
			     "update_user_ID",
			     "tbl_users", 
			     "user_ID", 
			     "RESTRICT", 
			     "CASCADE");

/*********************** table groups ****************************************/                          
/*****************************************************************************/
/* In de tabel tbl_groups is gedefinieerd welke groepen er voor een evenement zijn
/*****************************************************************************/
                            
	$this->createTable(
	    'tbl_groups', 
	    array(
			'group_ID'          => 'int(11) NOT NULL AUTO_INCREMENT',
			'group_name'        => 'string NOT NULL',
			'event_ID'          => 'int(11) NOT NULL',
			'create_time'       => 'datetime DEFAULT NULL',
			'create_user_ID'    => 'int(11) DEFAULT NULL',
			'update_time'       => 'datetime DEFAULT NULL',
			'update_user_ID'    => 'int(11) DEFAULT NULL',
			'PRIMARY KEY (`group_ID`)',
			'UNIQUE KEY(`event_ID`,`group_name`)',), 
	    'ENGINE=InnoDB'); 

/*****************************************************************************/
/* add foreignkays
/*****************************************************************************/
                     
/*****************************************************************************/
/* event_name en user_name in tbl_groups refereerd aan
/* event_name in tbl_events en user_name in tbl_users 
/*****************************************************************************/
   
	$this->addForeignKey("fk_groups_event_ID", 
			     "tbl_groups", 
			     "event_ID",
			     "tbl_event_names", 
			     "event_ID", 
			     "RESTRICT", 
			     "CASCADE");   
			     
	$this->addForeignKey("fk_groups_create_user", 
			     "tbl_groups", 
			     "create_user_ID",
			     "tbl_users", 
			     "user_ID", 
			     "RESTRICT", 
			     "CASCADE");
       
	$this->addForeignKey("fk_groups_update_user", 
			     "tbl_groups", 
			     "update_user_ID",
			     "tbl_users", 
			     "user_ID", 
			     "RESTRICT", 
			     "CASCADE");      
    
/*********************** table deelnemers_event ******************************/                         
/*****************************************************************************/
/* In de tabel tbl_deelnemers_event is een lijst van events met deelnemers.   
/* Een deelnemer kan maar 1 keer per event voorkomen. En een deelnemer heeft 
/* een rol. Deze rol bepaald wat een deelnemer kan doen als hij ingelogd is.
/* Als de rol een loper is, dan kan er ook aangegeven worden in welke groep 
/* deze persoon zit. 
/*****************************************************************************/                          
                            
	$this->createTable(
	    'tbl_deelnemers_event',                           
	    array(
			'deelnemers_ID'     => 'int(11) NOT NULL AUTO_INCREMENT', 
			'event_ID'          => 'int(11) NOT NULL',
			'user_ID'           => 'int(11) NOT NULL',
			'rol'        	    => 'int(11) DEFAULT NULL',
			'group_ID'          => 'int(11) DEFAULT NULL',
			'create_time'       => 'datetime DEFAULT NULL',
			'create_user_ID'    => 'int(11) DEFAULT NULL',
			'update_time'       => 'datetime DEFAULT NULL',
			'update_user_ID'    => 'int(11) DEFAULT NULL',
			'PRIMARY KEY (`deelnemers_ID`)',
			'UNIQUE KEY (`event_ID`, `user_ID`)',),                           
	    'ENGINE=InnoDB');                
       
/*****************************************************************************/
/* add foreignkays
/*****************************************************************************/
                        
	$this->addForeignKey("fk_deelnemers_event_event_ID", 
			     "tbl_deelnemers_event", 
			     "event_ID",
			     "tbl_event_names", 
			     "event_ID", 
			     "RESTRICT", 
			     "CASCADE");             
      
	$this->addForeignKey("fk_deelnemers_user_id", 
			     "tbl_deelnemers_event", 
			     "user_ID",
			     "tbl_users", 
			     "user_ID", 
			     "RESTRICT", 
			     "CASCADE");
			      
	$this->addForeignKey("fk_deelnemers_group_ID", 
			     "tbl_deelnemers_event", 
			     "group_ID",
			     "tbl_groups", 
			     "group_ID", 
			     "RESTRICT", 
			     "CASCADE");    
			 
	$this->addForeignKey("fk_deelnemers_create_user", 
			     "tbl_deelnemers_event", 
			     "create_user_ID",
			     "tbl_users", 
			     "user_ID", 
			     "RESTRICT", 
			     "CASCADE");
       
	$this->addForeignKey("fk_deelnemers_update_user", 
			     "tbl_deelnemers_event", 
			     "update_user_ID",
			     "tbl_users", 
			     "user_ID", 
			     "RESTRICT", 
			     "CASCADE");  
   
/*****************************************************************************/
/* Hier wordt per Route ID een open vraag gemaakt. 
/* Elke vraag moet handmatig gecontroleerd worden en goed gekeurd worden
/* Ook kan het goede antwoord hier opgeslagen worden. Dit kan dan getoond worden 
/* bij de controle. Dit moet echter wel handmatig gecontroleerd worden. 
/*****************************************************************************/                          
	$this->createTable(
	    'tbl_open_vragen', 
        array(
	    	'open_vragen_ID'    => 'int(11) NOT NULL AUTO_INCREMENT', 
			'open_vragen_name'  => 'string NOT NULL',
			'event_ID'          => 'int(11) NOT NULL',
			'route_ID' 	    	=> 'int(11) NOT NULL',
			'vraag_volgorde'    => 'int(11) DEFAULT NULL',
			'omschrijving'      => 'text NOT NULL',  
			'vraag'             => 'string NOT NULL',
			'goede_antwoord'    => 'string NOT NULL',
			'score'    	    	=> 'int(11) NOT NULL',
			'create_time'       => 'datetime DEFAULT NULL',
			'create_user_ID'    => 'int(11) DEFAULT NULL',
			'update_time'       => 'datetime DEFAULT NULL',
			'update_user_ID'    => 'int(11) DEFAULT NULL',
			'PRIMARY KEY (`open_vragen_ID`)',
			'UNIQUE KEY(`open_vragen_name`)',), 
	    'ENGINE=InnoDB'); 


/*********************** table open_vragen **********************************/
         
	$this->addForeignKey("fk_open_vragen_event_id", 
			     "tbl_open_vragen", 
			     "event_ID",
			     "tbl_event_names", 
			     "event_ID", 
			     "RESTRICT", 
			     "CASCADE");
	    
	$this->addForeignKey("fk_open_vragen_route", 
			     "tbl_open_vragen", 
			     "route_ID",
			     "tbl_route", 
			     "route_ID", 
			     "RESTRICT", 
			     "CASCADE");

	$this->addForeignKey("fk_open_vragen_create_user", 
			     "tbl_open_vragen", 
			     "create_user_ID",
			     "tbl_users", 
			     "user_ID", 
			     "RESTRICT", 
			     "CASCADE");
	  
	$this->addForeignKey("fk_open_vragen_update_user", 
			     "tbl_open_vragen", 
			     "update_user_ID",
			     "tbl_users", 
			     "user_ID", 
			     "RESTRICT", 
			     "CASCADE");  

 
/*****************************************************************************/
/* Hier worden de antwoorden van de groepjes opgeslagen. 
/* Elk antwoord moet gecontroleerd worden en goegekeurd worden
/*****************************************************************************/  
         	
	$this->createTable(
	    'tbl_open_vragen_antwoorden', 
	    array(
			'open_vragen_antwoorden_ID' => 'int(11) NOT NULL AUTO_INCREMENT', 
			'open_vragen_ID'            => 'int(11) NOT NULL', 
			'event_ID'          	    => 'int(11) NOT NULL',
			'group_ID'  		    	=> 'int(11) NOT NULL',
			'antwoord_spelers'          => 'string NOT NULL',
			'checked'  		    		=> 'boolean DEFAULT NULL',
			'correct'  		    		=> 'boolean DEFAULT NULL',
			'create_time'       	    => 'datetime DEFAULT NULL',
			'create_user_ID'            => 'int(11) DEFAULT NULL',
			'update_time'               => 'datetime DEFAULT NULL',
			'update_user_ID'       	    => 'int(11) DEFAULT NULL',
			'PRIMARY KEY (`open_vragen_antwoorden_ID`)',
			'UNIQUE KEY (`open_vragen_ID`, `group_ID`)',), 
	    'ENGINE=InnoDB'); 

/*********************** table aopen_vragen_antwoorden ***********************/
 
	$this->addForeignKey("fk_open_vragen_antwoorden_vragen_id", 
			     "tbl_open_vragen_antwoorden", 
			     "open_vragen_ID",
			     "tbl_open_vragen", 
			     "open_vragen_ID", 
			     "RESTRICT", 
			     "CASCADE");
	         
	$this->addForeignKey("fk_open_vragen_antwoorden_event_id", 
			     "tbl_open_vragen_antwoorden", 
			     "event_ID",
			     "tbl_event_names", 
			     "event_ID", 
			     "RESTRICT", 
			     "CASCADE");

	$this->addForeignKey("fk_open_vragen_antwoorden_group_id", 
			     "tbl_open_vragen_antwoorden", 
			     "group_ID",
			     "tbl_groups", 
			     "group_ID", 
			     "RESTRICT", 
			     "CASCADE"); 

	$this->addForeignKey("fk_open_vragen_antwoorden_create_user", 
			     "tbl_open_vragen_antwoorden", 
			     "create_user_ID",
			     "tbl_users", 
			     "user_ID", 
			     "RESTRICT", 
			     "CASCADE");
	
	$this->addForeignKey("fk_open_vragen_antwoorden_update_user", 
			     "tbl_open_vragen_antwoorden", 
			     "update_user_ID",
			     "tbl_users", 
			     "user_ID", 
			     "RESTRICT", 
			     "CASCADE");

/*****************************************************************************/
/* Hier kunnen een aantal posten ingevoerd worden. Dit luisterd niet heel nauw  
/* Deelnemers krijgen niet te zien welke posten er zijn, pas als ze hem 
/* gepasseerd zijn. Maak bij voorkeur te veel posten aan. De posten die je 
/* uiteindelijk niet gebruikt hebben geen invloed. Tijdens het spel posten 
/* bijmaken is lastiger.  
/*********** TIP TIP TIP TIP**************************************************/
/* Definieer startpunt en eindpunt van elke dag ook als een post. 
/*****************************************************************************/  						

	$this->createTable(
	    'tbl_posten', 
	    array( 
			'post_ID'   	=> 'int(11) NOT NULL AUTO_INCREMENT', 	
			'post_name'     => 'string NOT NULL',	
			'event_ID'      => 'int(11) NOT NULL',	
			'date'         	=> 'date DEFAULT NULL',
			'post_volgorde' => 'int(11) DEFAULT NULL',  
			'score'         => 'int(11) DEFAULT NULL', 
			'create_time'   => 'datetime DEFAULT NULL',
			'create_user_ID'=> 'int(11) DEFAULT NULL',
			'update_time'   => 'datetime DEFAULT NULL',
			'update_user_ID'=> 'int(11) DEFAULT NULL',
			'PRIMARY KEY (`post_ID`)',
			'UNIQUE KEY(`post_name`, `event_ID`, `date`)',), 
	    'ENGINE=InnoDB'); 
                      
 
/*********************** table posten  **********************************/
 
	$this->addForeignKey("fk_posten_event_name", 
			     "tbl_posten", 
			     "event_ID",
			     "tbl_event_names", 
			     "event_ID", 
			     "RESTRICT", 
			     "CASCADE");
			     
	$this->addForeignKey("fk_posten_create_user", 
			     "tbl_posten", 
			     "create_user_ID",
			     "tbl_users", 
			     "user_ID", 
			     "RESTRICT", 
			     "CASCADE");
	
	$this->addForeignKey("fk_posten_update_user", 
			     "tbl_posten", 
			     "update_user_ID",
			     "tbl_users", 
			     "user_ID", 
			     "RESTRICT", 
			     "CASCADE"); 

/*****************************************************************************/
/* Hier kan je aangeven welke groepen langs welke posten komen en hoelaat
/*****************************************************************************/  	
							
	$this->createTable(
	    'tbl_post_passage', 
	    array(
			'posten_passage_ID' => 'int(11) NOT NULL AUTO_INCREMENT', 	
			'post_ID'           => 'int(11) NOT NULL', 		
			'event_ID'          => 'int(11) NOT NULL',	
			'group_ID'  	    => 'int(11) NOT NULL',
			'gepasseerd'  	    => 'tinyint(11) NOT NULL',
			'binnenkomst'       => 'datetime DEFAULT NULL',
			'vertrek'           => 'datetime DEFAULT NULL',
			'create_time'       => 'datetime DEFAULT NULL',
			'create_user_ID'    => 'int(11) DEFAULT NULL',
			'update_time'       => 'datetime DEFAULT NULL',
			'update_user_ID'    => 'int(11) DEFAULT NULL',
			'PRIMARY KEY (`posten_passage_ID`)',
			'UNIQUE KEY (`post_ID`, `event_ID`, `group_ID`)',), 
	    'ENGINE=InnoDB'); 

/*********************** table post_passages ****************************/
 
	$this->addForeignKey("fk_post_passage_post_id", 
			     "tbl_post_passage", 
			     "post_ID",
			     "tbl_posten", 
			     "post_ID", 
			     "RESTRICT", 
			     "CASCADE");
    
	$this->addForeignKey("fk_post_passage_event_id", 
			     "tbl_post_passage", 
			     "event_ID",
			     "tbl_event_names", 
			     "event_ID", 
			     "RESTRICT", 
			     "CASCADE");
    
	$this->addForeignKey("fk_post_passage_group_name", 
			     "tbl_post_passage", 
			     "group_ID",
			     "tbl_groups", 
			     "group_ID", 
			     "RESTRICT", 
			     "CASCADE");

	$this->addForeignKey("fk_post_passage_create_user", 
			     "tbl_post_passage", 
			     "create_user_ID",
			     "tbl_users", 
			     "user_ID", 
			     "RESTRICT", 
			     "CASCADE");
    
	$this->addForeignKey("fk_post_passage_update_user", 
			     "tbl_post_passage", 
			     "update_user_ID",
			     "tbl_users", 
			     "user_ID", 
			     "RESTRICT", 
			     "CASCADE"); 
     

/*****************************************************************************/
/* Bonuspunten Hier kunnen extra (straf)punten gegeven worden aan groepjes
/* Vul negatieve waarden in voor straf punten.
/* 
/*****************************************************************************/  	
							
	$this->createTable(
	    'tbl_bonuspunten', 
	    array(
			'bouspunten_ID' => 'int(11) NOT NULL AUTO_INCREMENT', 
			'event_ID'      => 'int(11) NOT NULL',
			'date'          => 'date DEFAULT NULL',									
			'post_ID'       => 'int(11) DEFAULT NULL',
			'group_ID'      => 'int(11) NOT NULL',
			'omschrijving'  => 'string NOT NULL',
			'score'         => 'int(11) DEFAULT NULL', 
			'create_time'   => 'datetime DEFAULT NULL',
			'create_user_ID'=> 'int(11) DEFAULT NULL',
			'update_time'   => 'datetime DEFAULT NULL',
			'update_user_ID'=> 'int(11) DEFAULT NULL',
			'PRIMARY KEY (`bouspunten_ID`)'), 
	    'ENGINE=InnoDB'); 
	
/*********************** table bonuspunten ****************************/
  
	$this->addForeignKey("fk_bonuspunten_event_id", 
			     "tbl_bonuspunten", 
			     "event_ID",
			     "tbl_event_names", 
			     "event_ID", 
			     "RESTRICT", 
			     "CASCADE");
    
	$this->addForeignKey("fk_bonuspunten_post_id", 
			     "tbl_bonuspunten", 
			     "post_ID",
			     "tbl_posten", 
			     "post_ID", 
			     "RESTRICT", 
			     "CASCADE");
    
	$this->addForeignKey("fk_bonuspunten_group_id", 
			     "tbl_bonuspunten", 
			     "group_ID",
			     "tbl_groups", 
			     "group_ID", 
			     "RESTRICT", 
			     "CASCADE");
    
	$this->addForeignKey("fk_bonuspunten_create_user", 
			     "tbl_bonuspunten", 
			     "create_user_ID",
			     "tbl_users", 
			     "user_ID", 
			     "RESTRICT", 
			     "CASCADE");
    
	$this->addForeignKey("fk_bonuspunten_update_user", 
			     "tbl_bonuspunten", 
			     "update_user_ID",
			     "tbl_users", 
			     "user_ID", 
			     "RESTRICT", 
			     "CASCADE"); 
  
/*****************************************************************************/
/* Vriendenlijst
/* In deze tabel staan de vriendschappen gedefinieerd. 
/* 
/*****************************************************************************/

	$this->createTable(
	    'tbl_friend_list',
	    array(
			'friend_list_ID'		=> 'int(11) NOT NULL AUTO_INCREMENT',
			'user_ID' 				=> 'int(11) DEFAULT NULL',
			'friends_with_user_ID' 	=> 'int(11) DEFAULT NULL',
			'status' 				=> 'int(11) DEFAULT NULL',
			'create_time' 			=> 'datetime DEFAULT NULL',
			'create_user_ID' 		=> 'int(11) DEFAULT NULL',
			'update_time' 			=> 'datetime DEFAULT NULL',
			'update_user_ID' 		=> 'int(11) DEFAULT NULL',
			'PRIMARY KEY (`friend_list_ID`)',
			'UNIQUE KEY `friendship_ID` (`user_ID`,`friends_with_user_ID`)'),
	    'ENGINE=InnoDB');

/*********************** table friens_list ****************************/
  
	$this->addForeignKey("fk_friend_list_user", 
			     "tbl_friend_list", 
			     "user_ID",
			     "tbl_users", 
			     "user_ID", 
			     "RESTRICT", 
			     "CASCADE");
	
	$this->addForeignKey("fk_friend_list_friends_with_user", 
			     "tbl_friend_list", 
			     "friends_with_user_ID",
			     "tbl_users", 
			     "user_ID", 
			     "RESTRICT", 
			     "CASCADE"); 

	$this->addForeignKey("fk_friend_list_create_user", 
			     "tbl_friend_list", 
			     "create_user_ID",
			     "tbl_users", 
			     "user_ID", 
			     "RESTRICT", 
			     "CASCADE");
	
	$this->addForeignKey("fk_friend_list_update_user", 
			     "tbl_friend_list", 
			     "update_user_ID",
			     "tbl_users", 
			     "user_ID", 
			     "RESTRICT", 
			     "CASCADE"); 

/*****************************************************************************/
/* Nood enveloppen 
/* In deze tabel staan de de hints gedefinieerd. 
/* 
/*****************************************************************************/

	$this->createTable(
	    'tbl_nood_envelop',
	    array(
			'nood_envelop_ID'   	=> 'int(11) NOT NULL AUTO_INCREMENT',
			'nood_envelop_name'		=> 'varchar(255) NOT NULL',
			'event_ID' 	    		=> 'int(11) NOT NULL',
			'route_ID' 				=> 'int(11) NOT NULL',
			'nood_envelop_volgorde'	=> 'int(11) DEFAULT NULL',
			'coordinaat' 			=> 'varchar(255) NOT NULL',
			'opmerkingen' 			=> 'varchar(255) NOT NULL',
			'score' 				=> 'int(11) NOT NULL',
			'create_time' 			=> 'datetime DEFAULT NULL',
			'create_user_ID' 		=> 'int(11) DEFAULT NULL',
			'update_time'			=> 'datetime DEFAULT NULL',
			'update_user_ID' 		=> 'int(11) DEFAULT NULL',
			'PRIMARY KEY (`nood_envelop_ID`)',
			'UNIQUE KEY `envelop_id` (`nood_envelop_name`,`event_ID`)'),
	    'ENGINE=InnoDB');

/*********************** table friens_list ****************************/
  
	$this->addForeignKey("fk_nood_envelop_event_id", 
			     "tbl_nood_envelop", 
			     "event_ID",
			     "tbl_event_names", 
			     "event_ID", 
			     "RESTRICT", 
			     "CASCADE");						

	$this->addForeignKey("fk_nood_envelop_route", 
			     "tbl_nood_envelop", 
			     "route_ID",
			     "tbl_route", 
			     "route_ID", 
			     "RESTRICT", 
			     "CASCADE");

	$this->addForeignKey("fk_nood_envelop_create_user", 
			     "tbl_nood_envelop", 
			     "create_user_ID",
			     "tbl_users", 
			     "user_ID", 
			     "RESTRICT", 
			     "CASCADE");
	
	$this->addForeignKey("fk_nood_envelop_update_user", 
			     "tbl_nood_envelop", 
			     "update_user_ID",
			     "tbl_users", 
			     "user_ID", 
			     "RESTRICT", 
			     "CASCADE");

/*****************************************************************************/
/* open nood enveloppen
/* In deze tabel staan de enveloppen die door een groepje zijn geopend. 
/* 
/*****************************************************************************/

	$this->createTable(
	    'tbl_open_nood_envelop',
	    array(
			'open_nood_envelop_ID'	=> 'int(11) NOT NULL AUTO_INCREMENT',
			'nood_envelop_ID'   	=> 'int(11) NOT NULL',
			'event_ID'   	    	=> 'int(11) NOT NULL',
			'group_ID'   			=> 'int(11) NOT NULL',
			'opened'   				=> 'tinyint(1) DEFAULT NULL',
			'create_time'   		=> 'datetime DEFAULT NULL',
			'create_user_ID'   		=> 'int(11) DEFAULT NULL',
			'update_time'   		=> 'datetime DEFAULT NULL',
			'update_user_ID'   		=> 'int(11) DEFAULT NULL',
			'PRIMARY KEY (`open_nood_envelop_ID`)',
			'UNIQUE KEY `nood_envelop_ID` (`nood_envelop_ID`,`group_ID`)',),
	    'ENGINE=InnoDB');


	$this->addForeignKey("fk_onood_envelop_id", 
			     "tbl_open_nood_envelop", 
			     "nood_envelop_ID",
			     "tbl_nood_envelop", 
			     "nood_envelop_ID", 
			     "RESTRICT", 
			     "CASCADE");

	$this->addForeignKey("fk_open_nood_envelop_event_id", 
			     "tbl_open_nood_envelop", 
			     "event_ID",
			     "tbl_event_names", 
			     "event_ID", 
			     "RESTRICT", 
			     "CASCADE");

	$this->addForeignKey("fk_open_nood_envelop_group_id", 
			     "tbl_open_nood_envelop", 
			     "group_ID",
			     "tbl_groups", 
			     "group_ID", 
			     "RESTRICT", 
			     "CASCADE");

	$this->addForeignKey("fk_onood_envelop_create_user", 
			     "tbl_open_nood_envelop", 
			     "create_user_ID",
			     "tbl_users", 
			     "user_ID", 
			     "RESTRICT", 
			     "CASCADE");
	
	$this->addForeignKey("fk_onood_envelop_update_user", 
			     "tbl_open_nood_envelop", 
			     "update_user_ID",
			     "tbl_users", 
			     "user_ID", 
			     "RESTRICT", 
			     "CASCADE");

/*****************************************************************************/
/* Vriendenlijst
/* In deze tabel staan de vriendschappen gedefinieerd. 
/* 
/*****************************************************************************/

	$this->createTable(
	    'tbl_qr',
	    array(
			'qr_ID'			=> 'int(11) NOT NULL AUTO_INCREMENT',
			'qr_name'		=> 'varchar(255) NOT NULL',
			'qr_code'		=> 'varchar(255) NOT NULL',
			'event_ID'		=> 'int(11) NOT NULL',
			'route_ID' 		=> 'int(11) NOT NULL',
			'qr_volgorde'	=> 'int(11) DEFAULT NULL',
			'score'			=> 'int(11) NOT NULL',
			'create_time'	=> 'datetime DEFAULT NULL',
			'create_user_ID'=> 'int(11) DEFAULT NULL',
			'update_time'	=> 'datetime DEFAULT NULL',
			'update_user_ID'=> 'int(11) DEFAULT NULL',
			'PRIMARY KEY (`qr_ID`)',
			'UNIQUE KEY `qr_code` (`qr_code`,`event_ID`)'),
    	'ENGINE=InnoDB');


	$this->addForeignKey("fk_qr_event_id", 
			     "tbl_qr", 
			     "event_ID",
			     "tbl_event_names", 
			     "event_ID", 
			     "RESTRICT", 
			     "CASCADE");

	$this->addForeignKey("fk_qr_route", 
			     "tbl_qr", 
			     "route_ID",
			     "tbl_route", 
			     "route_ID", 
			     "RESTRICT", 
			     "CASCADE");

	$this->addForeignKey("fk_qr_create_user", 
			     "tbl_qr", 
			     "create_user_ID",
			     "tbl_users", 
			     "user_ID", 
			     "RESTRICT", 
			     "CASCADE");
	
	$this->addForeignKey("fk_qr_update_user", 
			     "tbl_qr", 
			     "update_user_ID",
			     "tbl_users", 
			     "user_ID", 
			     "RESTRICT", 
			     "CASCADE");

/*****************************************************************************/
/* Vriendenlijst
/* In deze tabel staan de vriendschappen gedefinieerd. 
/* 
/*****************************************************************************/

	$this->createTable(
	    'tbl_qr_check',
	    array(
			'qr_check_ID'	=> 'int(11) NOT NULL AUTO_INCREMENT',
			'qr_ID'			=> 'int(11) NOT NULL',
			'event_ID'		=> 'int(11) NOT NULL',
			'group_ID'		=> 'int(11) NOT NULL',
			'create_time'	=> 'datetime DEFAULT NULL',
			'create_user_ID'=> 'int(11) DEFAULT NULL',
			'update_time'	=> 'datetime DEFAULT NULL',
			'update_user_ID'=> 'int(11) DEFAULT NULL',
			'PRIMARY KEY (`qr_check_ID`)',
			'UNIQUE KEY `qr_ID` (`qr_ID`,`group_ID`)'),
	    'ENGINE=InnoDB');


	$this->addForeignKey("fk_qr_check_qr_id", 
			     "tbl_qr_check", 
			     "qr_ID",
			     "tbl_qr", 
			     "qr_ID", 
			     "RESTRICT", 
			     "CASCADE");

	$this->addForeignKey("fk_qr_check_qr_event_id", 
			     "tbl_qr_check", 
			     "event_ID",
			     "tbl_event_names", 
			     "event_ID", 
			     "RESTRICT", 
			     "CASCADE");

	$this->addForeignKey("fk_qr_check_qr_group_id", 
			     "tbl_qr_check", 
			     "group_ID",
			     "tbl_groups", 
			     "group_ID", 
			     "RESTRICT", 
			     "CASCADE");

	$this->addForeignKey("fk_qr_check_create_user", 
			     "tbl_qr_check", 
			     "create_user_ID",
			     "tbl_users", 
			     "user_ID", 
			     "RESTRICT", 
			     "CASCADE");
	
	$this->addForeignKey("fk_qr_check_update_user", 
			     "tbl_qr_check", 
			     "update_user_ID",
			     "tbl_users", 
			     "user_ID", 
			     "RESTRICT", 
			     "CASCADE");
    }

    public function safeDown()
    {  
        $this->truncateTable('tbl_qr_check');
        $this->dropTable('tbl_qr_check');

        $this->truncateTable('tbl_qr');
        $this->dropTable('tbl_qr');

        $this->truncateTable('tbl_open_nood_envelop');
        $this->dropTable('tbl_open_nood_envelop');

        $this->truncateTable('tbl_nood_envelop');
        $this->dropTable('tbl_nood_envelop');

		$this->truncateTable('tbl_friend_list');
		$this->dropTable('tbl_friend_list');

        $this->truncateTable('tbl_bonuspunten');
        $this->dropTable('tbl_bonuspunten');

        $this->truncateTable('tbl_post_passage');
        $this->dropTable('tbl_post_passage');

        $this->truncateTable('tbl_posten');
        $this->dropTable('tbl_posten');

        $this->truncateTable('tbl_open_vragen_antwoorden');
        $this->dropTable('tbl_open_vragen_antwoorden');

        $this->truncateTable('tbl_open_vragen');
        $this->dropTable('tbl_open_vragen');

        $this->truncateTable('tbl_deelnemers_event');
        $this->dropTable('tbl_deelnemers_event');

        $this->truncateTable('tbl_groups');
        $this->dropTable('tbl_groups');

        $this->truncateTable('tbl_route');
        $this->dropTable('tbl_route');

        $this->truncateTable('tbl_event_names');
        $this->dropTable('tbl_event_names');

        $this->truncateTable('tbl_users');
        $this->dropTable('tbl_users');
    }	
    
    /*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}

