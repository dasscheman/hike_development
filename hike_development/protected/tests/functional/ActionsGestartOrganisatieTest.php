<?php
class ActionGestartOrganisatieTest extends WebTestCase
{
    /*
     *	For debugging use:
     * 	$this->assertContains("ASDFASDFASDF", $this->getBodyText());
     */

    protected function setUp()
    {
        $this->setBrowser('*firefox');
        $this->setBrowserUrl('http://localhost/');
        $this->shareSession(true);
    }

    public function testLoadPage()
    {
    	$this->open('hike_development/index-test.php');
        $this->waitForPageToLoad ( "30000" );
	$this->assertContains("HIKE-app", $this->getBodyText());
    }

    public function testLogin()
    {
	$this->open("hike_development/index-test.php?r=game/gameoverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
	$this->assertContains("hike_development/index-test.php?r=site/login", $this->getLocation());
	$this->type("id=LoginForm_username", "organisatie");
	$this->type("id=LoginForm_password", "test");
	$this->click("name=yt0");
	$this->waitForPageToLoad("30000");
	$this->assertContains("hike_development/index-test.php?r=game/gameoverview&event_id=3", $this->getLocation());
    }

    ##Game Overview:
    public function testVragenControleren()
    {
	$this->open("hike_development/index-test.php?r=site/login");
	$this->assertContains("hike_development/index-test.php?r=site/login", $this->getLocation());
	$this->type("id=LoginForm_username", "organisatie");
	$this->type("id=LoginForm_password", "test");
	$this->click("name=yt0");
	$this->waitForPageToLoad("30000");
    	$this->open("hike_development/index-test.php?r=game/gameoverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
	$this->assertContains("hike_development/index-test.php?r=game/gameoverview&event_id=3", $this->getLocation());
	$this->click("link=Vragen Controleren");
	// can be done with: $this->click("//ul[@id='yw2']/li/a/span/i[3]");
        $this->waitForPageToLoad ( "30000" );
	$this->assertContains("hike_development/index-test.php?r=openVragenAntwoorden/viewControle&event_id=3", $this->getLocation());

    }


    public function testBonuspuntenGeven()
    {
	$this->open("hike_development/index-test.php?r=site/login");
	$this->assertContains("hike_development/index-test.php?r=site/login", $this->getLocation());
	$this->type("id=LoginForm_username", "organisatie");
	$this->type("id=LoginForm_password", "test");
	$this->click("name=yt0");
	$this->waitForPageToLoad("30000");
    	$this->open("hike_development/index-test.php?r=game/gameoverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
	$this->assertContains("hike_development/index-test.php?r=game/gameoverview&event_id=3", $this->getLocation());
	$this->click("link=Bonuspunten Geven");
        $this->waitForPageToLoad ( "30000" );
	$this->assertContains("hike_development/index-test.php?r=openVragenAntwoorden/viewControle&event_id=3", $this->getLocation());
    }

    public function testBeantwoordeVragenBekijken()
    {
	$this->open("hike_development/index-test.php?r=site/login");
	$this->assertContains("hike_development/index-test.php?r=site/login", $this->getLocation());
	$this->type("id=LoginForm_username", "organisatie");
	$this->type("id=LoginForm_password", "test");
	$this->click("name=yt0");
	$this->waitForPageToLoad("30000");
    	$this->open("hike_development/index-test.php?r=game/gameoverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
	$this->assertContains("hike_development/index-test.php?r=game/gameoverview&event_id=3", $this->getLocation());
	$this->click("link=Beantwoorde Vragen");
        $this->waitForPageToLoad ( "30000" );
	$this->assertContains("hike_development/index-test.php?r=openVragenAntwoorden/viewControle&event_id=3", $this->getLocation());
    }

    public function testGeopendeHintsBekijken()
    {
	$this->open("hike_development/index-test.php?r=site/login");
	$this->assertContains("hike_development/index-test.php?r=site/login", $this->getLocation());
	$this->type("id=LoginForm_username", "organisatie");
	$this->type("id=LoginForm_password", "test");
	$this->click("name=yt0");
	$this->waitForPageToLoad("30000");
    	$this->open("hike_development/index-test.php?r=game/gameoverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
	$this->assertContains("hike_development/index-test.php?r=game/gameoverview&event_id=3", $this->getLocation());
	$this->click("link=Geopende Hints");
        $this->waitForPageToLoad ( "30000" );
	$this->assertContains("hike_development/index-test.php?r=openVragenAntwoorden/viewControle&event_id=3", $this->getLocation());
    }

    public function testBonuspuntenBekijken()
    {
	$this->open("hike_development/index-test.php?r=site/login");
	$this->assertContains("hike_development/index-test.php?r=site/login", $this->getLocation());
	$this->type("id=LoginForm_username", "organisatie");
	$this->type("id=LoginForm_password", "test");
	$this->click("name=yt0");
	$this->waitForPageToLoad("30000");
    	$this->open("hike_development/index-test.php?r=game/gameoverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
	$this->assertContains("hike_development/index-test.php?r=game/gameoverview&event_id=3", $this->getLocation());
	$this->click("link=Bonuspunten Overzicht");
        $this->waitForPageToLoad ( "30000" );
	$this->assertContains("hike_development/index-test.php?r=openVragenAntwoorden/viewControle&event_id=3", $this->getLocation());
    }

    public function testGepasserdePostenBekijken()
    {
	$this->open("hike_development/index-test.php?r=site/login");
	$this->assertContains("hike_development/index-test.php?r=site/login", $this->getLocation());
	$this->type("id=LoginForm_username", "organisatie");
	$this->type("id=LoginForm_password", "test");
	$this->click("name=yt0");
	$this->waitForPageToLoad("30000");
    	$this->open("hike_development/index-test.php?r=game/gameoverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
	$this->assertContains("hike_development/index-test.php?r=game/gameoverview&event_id=3", $this->getLocation());
	$this->click("link=Gepasserde Posten");
        $this->waitForPageToLoad ( "30000" );
	$this->assertContains("hike_development/index-test.php?r=openVragenAntwoorden/viewControle&event_id=3", $this->getLocation());
    }

    public function testGecheckteStillePostenBekijken()
    {
	$this->open("hike_development/index-test.php?r=site/login");
	$this->assertContains("hike_development/index-test.php?r=site/login", $this->getLocation());
	$this->type("id=LoginForm_username", "organisatie");
	$this->type("id=LoginForm_password", "test");
	$this->click("name=yt0");
	$this->waitForPageToLoad("30000");
    	$this->open("hike_development/index-test.php?r=game/gameoverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
	$this->assertContains("hike_development/index-test.php?r=game/gameoverview&event_id=3", $this->getLocation());
	$this->click("link=Stille Posten");
        $this->waitForPageToLoad ( "30000" );
	$this->assertContains("hike_development/index-test.php?r=openVragenAntwoorden/viewControle&event_id=3", $this->getLocation());
    }

    ## Group Overview

    ## Startup Overview
}