<?php

class CreateHikeTest extends WebTestCase
{
	public function testNewHike()
    {
        $this->open('eventNames/create');
        // verify the sample post title exists
        $this->type("id=EventNames_event_name", "Nieuwe Test HIKE");
        $this->type("id=end_date", "2015-19-08");
        $this->type("id=end_date", "2015-19-11");
        $this->click("css=input[type=\"submit\"]");
        $this->waiForPageToLoad("5000");
			
        // verify comment form exists
        $this->assertTextPresent('Leave a Comment');
    }	
		
	public function testAddNewPlayersToHike()
    {
        $this->open('DeelnemersEvent/create');
        // verify the sample post title exists
        $this->type("id=EventNames_event_name", "Nieuwe Test HIKE");
        $this->type("id=end_date", "2015-19-08");
        $this->type("id=end_date", "2015-19-11");
        $this->click("css=input[type=\"submit\"]");
        $this->waiForPageToLoad("5000");
			
        // verify comment form exists
        $this->assertTextPresent('Leave a Comment');
    }
	
	public function testChangeStatusHike()
    {
        $this->open('eventNames/changeStatus');
        // verify the sample post title exists
        $this->type("id=EventNames_event_name", "Nieuwe Test HIKE");
        $this->type("id=end_date", "2015-19-08");
        $this->type("id=end_date", "2015-19-11");
        $this->click("css=input[type=\"submit\"]");
        $this->waiForPageToLoad("5000");
			
        // verify comment form exists
        $this->assertTextPresent('Leave a Comment');
    }
	
	public function testChangeDayHike()
    {
        $this->open('eventNames/changeDay');
        // verify the sample post title exists
        $this->type("id=EventNames_event_name", "Nieuwe Test HIKE");
        $this->type("id=end_date", "2015-19-08");
        $this->type("id=end_date", "2015-19-11");
        $this->click("css=input[type=\"submit\"]");
        $this->waiForPageToLoad("5000");
			
        // verify comment form exists
        $this->assertTextPresent('Leave a Comment');
    }
}