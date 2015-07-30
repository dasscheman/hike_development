<?php

class ActionGestartPlayersTest extends WebTestCase
{
    /*
     *	For debugging use:
     * 	$this->assertContains("ASDFASDFASDF", $this->getBodyText());
     *
     *	Check of een link niet bestaat:
     *  $this->assertFalse($this->isElementPresent("link=NG_011986.11"));
     *
     *  Check of een link wel bestaat:
     *  $this->assertTrue($this->isElementPresent("link=NG_011986.11"));
     */

    protected function setUp()
    {
        $this->setBrowser('*firefox');
        $this->setBrowserUrl('http://localhost/');
        $this->shareSession(true);
    }

    public function login()
    {
		$this->open("hike_development/index-test.php?r=site/login");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=site/login", $this->getLocation());
		$this->type("id=LoginForm_username", "deelnemera");
		$this->type("id=LoginForm_password", "test");
		$this->click("name=yt0");
		$this->waitForPageToLoad("30000");
    }

    public function testLoadPage()
    {
    	$this->open('hike_development/index-test.php');
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("HIKE-app", $this->getBodyText());
    }

    public function testLogin()
    {
		$this->login();
		$this->open("hike_development/index-test.php?r=game/gameoverview&event_id=3");
		$this->assertContains("hike_development/index-test.php?r=game/gameoverview&event_id=3", $this->getLocation());
    }

    ##Game Overview:
    public function testVragenControleren()
    {
		$this->login();
    	$this->open("hike_development/index-test.php?r=game/gameoverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameoverview&event_id=3", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Vragen Controleren"));
		$this->open("hike_development/index-test.php?r=openVragenAntwoorden/viewControle&event_id=3");
		$this->assertContains("Dat mag dus niet...", $this->getBodyText());
    }


    public function testBonuspuntenGeven()
    {
		$this->login();
    	$this->open("hike_development/index-test.php?r=game/gameoverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameoverview&event_id=3", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Bonuspunten Geven"));
		$this->open("hike_development/index-test.php?r=openVragenAntwoorden/viewControle&event_id=3");
		$this->assertContains("Dat mag dus niet...", $this->getBodyText());
    }

    public function testBeantwoordeVragenBekijken()
    {
		$this->login();
    	$this->open("hike_development/index-test.php?r=game/gameoverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameoverview&event_id=3", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Beantwoorde Vragen"));
		$this->click("link=Beantwoorde Vragen");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=openVragenAntwoorden/viewControle&event_id=3", $this->getLocation());
    }

    public function testGeopendeHintsBekijken()
    {
		$this->login();
    	$this->open("hike_development/index-test.php?r=game/gameoverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameoverview&event_id=3", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Geopende Hints"));
		$this->click("link=Geopende Hints");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=openVragenAntwoorden/viewControle&event_id=3", $this->getLocation());
    }

    public function testBonuspuntenBekijken()
    {
		$this->login();
    	$this->open("hike_development/index-test.php?r=game/gameoverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameoverview&event_id=3", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Bonuspunten Overzicht"));
		$this->click("link=Bonuspunten Overzicht");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=openVragenAntwoorden/viewControle&event_id=3", $this->getLocation());
    }

    public function testGepasserdePostenBekijken()
    {
		$this->login();
    	$this->open("hike_development/index-test.php?r=game/gameoverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameoverview&event_id=3", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Gepasserde Posten"));
		$this->click("link=Gepasserde Posten");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=openVragenAntwoorden/viewControle&event_id=3", $this->getLocation());
    }

    public function testGecheckteStillePostenBekijken()
    {
		$this->login();
    	$this->open("hike_development/index-test.php?r=game/gameoverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameoverview&event_id=3", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Stille Posten"));
		$this->click("link=Stille Posten");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=openVragenAntwoorden/viewControle&event_id=3", $this->getLocation());
    }

    ## Group Overview

    ## Startup Overview
}