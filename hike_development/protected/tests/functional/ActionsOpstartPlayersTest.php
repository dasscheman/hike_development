<?php

class ActionOpstartPlayersTest extends WebTestCase
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
 	 *
	 * DATA:
	 * event_id = 1;
	 * route_id = 1, 2;
	 * group_id = 1, 2;
	 * bonuspunten_id = ;
	 * openVragen_id = 6, 7;
	 * noodenvelop_id = 4;
	 * qr_id = 3, 4;
	 * post_id = 6, 7;
     */

    protected function setUp()
    {
        $this->setBrowser('*firefox');
        $this->setBrowserUrl('http://localhost/');
        $this->shareSession(false);
    }

    public function login()
    {
		$this->pause(3);
		$this->open("hike_development/index-test.php?r=site/logout");
        $this->waitForPageToLoad ( "30000" );
		$this->open("hike_development/index-test.php?r=site/login");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=site/login", $this->getLocation());
		$this->type("id=LoginForm_username", "deelnemera");
		$this->type("id=LoginForm_password", "test");
		$this->check("id=LoginForm_rememberMe");
		$this->click("name=yt0");
		$this->waitForPageToLoad("30000");
		$this->assertContains("hike_development/index-test.php", $this->getLocation());
		$this->assertContains("Gebruikersnaam: deelnemera", $this->getBodyText());
    }

    public function testLoadPage()
    {
    	$this->open('hike_development/index-test.php');
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("HIKE-app", $this->getBodyText());
    }

    public function testLoginAndGameOverview()
    {
		$this->login();

		$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=1");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=1", $this->getLocation());
        $this->assertContains("Status van Hike: Opstart", $this->getBodyText());
        $this->assertContains("nvt", $this->getBodyText());
    }

    ##Game Overview:
    public function testVragenControleren()
    {
		$this->login();

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=1");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=1", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Vragen Controleren"));
		$this->open("hike_development/index-test.php?r=openVragenAntwoorden/viewControle&event_id=1");
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());

        #data aanmaken:
		$this->open("hike_development/index-test.php?r=openVragenAntwoorden/antwoordGoedOfFout&id=>1&goedfout=>0&event_id=>1");
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
		$this->open("hike_development/index-test.php?r=openVragenAntwoorden/antwoordGoedOfFout&id=>2&goedfout=>1&event_id=>1");
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
    }


    public function testBonuspuntenGeven()
    {
		$this->login();

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=1");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=1", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Bonuspunten Geven"));
		$this->open("hike_development/index-test.php?r=bonuspunten/create&event_id=1");
		$this->waitForPageToLoad("30000");
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
    }

    public function testBeantwoordeVragenBekijken()
    {
		$this->login();

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=1");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=1", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Beantwoorde Vragen"));
		$this->open("hike_development/index-test.php?r=openVragenAntwoorden/index&event_id=1");
        $this->waitForPageToLoad ( "30000" );
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testGeopendeHintsBekijken()
    {
		$this->login();

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=1");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=1", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Geopende Hints"));
		$this->open("hike_development/index-test.php?r=openNoodEnvelop/index&event_id=1");
		$this->waitForPageToLoad ( "30000" );
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testBonuspuntenBekijken()
    {
		$this->login();

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=1");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=1", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Bonuspunten Overzicht"));
		$this->open("hike_development/index-test.php?r=bonuspunten/index&event_id=1");
        $this->waitForPageToLoad ( "30000" );
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testGepasserdePostenBekijken()
    {
		$this->login();

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=1");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=1", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Gepasserde Posten"));
		$this->open("hike_development/index-test.php?r=postPassage/index&event_id=1");
        $this->waitForPageToLoad ( "30000" );
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testGecheckteStillePostenBekijken()
    {
		$this->login();

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=1");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=1", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Stille Posten"));
		$this->open("hike_development/index-test.php?r=QrCheck/index&event_id=1");
        $this->waitForPageToLoad ( "30000" );
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    ## Group Overview
    public function testLoadGroupOverview()
	{
		$this->login();

		# bekijken van gegevens van andere groep.
		$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=1&group_id=2");
		$this->waitForPageToLoad ( "30000" );
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());

		# bekijken van gegevens van eigen groep.
    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=1&group_id=1");
		$this->waitForPageToLoad ( "30000" );
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testPostBinnenkomst()
	{
		$this->login();

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=1&group_id=1");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=1&group_id=1", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Binnenkomst Post"));
		$this->open("hike_development/index-test.php?r=postPassage/create&event_id=1&group_id=1");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

	public function testGroupsVragenBekijken()
	{
		$this->login();

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=1&group_id=1");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=1&group_id=1", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Vragen"));
		$this->open("hike_development/index-test.php?r=openVragen/viewPlayers&event_id=1&group_id=1");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("Dat mag dus niet...", $this->getBodyText());

		$this->open("hike_development/index-test.php?r=openVragenAntwoorden/update&event_id=1&group_id=2&vraag_id=1");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("Dat mag dus niet...", $this->getBodyText());

		$this->open("hike_development/index-test.php?r=openVragenAntwoorden/update&event_id=1&group_id=1&vraag_id=1");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("Dat mag dus niet...", $this->getBodyText());

		$this->open("hike_development/index-test.php?r=openVragenAntwoorden/viewPlayers&event_id=1&group_id=1");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

	public function testGroupsBeantwoordenVragenBekijken()
	{
		$this->login();

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=1&group_id=1");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("Dat mag dus niet...", $this->getBodyText());

		$this->open("hike_development/index-test.php?r=openVragenAntwoorden/viewPlayers&event_id=1&group_id=1");
		$this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

	public function testGroupsHintsBekijken()
	{
		$this->login();

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=1&group_id=1");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("Dat mag dus niet...", $this->getBodyText());

		$this->open("hike_development/index-test.php?r=noodEnvelop/viewPlayers&event_id=1&group_id=1");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=noodEnvelop/viewPlayers&event_id=1&group_id=1", $this->getLocation());
		$this->assertContains("Dat mag dus niet...", $this->getBodyText());

    	$this->open("hike_development/index-test.php?r=openNoodEnvelop/create&nood_envelop_id=2&event_id=1&group_id=1");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=openNoodEnvelop/create&nood_envelop_id=2&event_id=1&group_id=1", $this->getLocation());
		$this->assertContains("Dat mag dus niet...", $this->getBodyText());
		
		$this->open("hike_development/index-test.php?r=openNoodEnvelop/create&nood_envelop_id=3&event_id=1&group_id=2");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=openNoodEnvelop/create&nood_envelop_id=3&event_id=1&group_id=2", $this->getLocation());
		$this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

	public function testGroupsBonuspuntenBekijken()
	{
		$this->login();

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=1&group_id=1");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=1&group_id=1", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Bonuspunten"));
		$this->open("hike_development/index-test.php?r=bonuspunten/viewPlayers&event_id=1&group_id=1");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=bonuspunten/viewPlayers&event_id=1&group_id=1", $this->getLocation());
		$this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

	public function testGroupsStillePostenBekijken()
	{
		$this->login();

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=1&group_id=1");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=1&group_id=1", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Stille Posten"));
		$this->open("hike_development/index-test.php?r=qrCheck/viewPlayers&event_id=1&group_id=1");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=qrCheck/viewPlayers&event_id=1&group_id=1", $this->getLocation());
		$this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}
    ## Startup Overview
    public function testLoginAndStartupOverview()
    {
		$this->login();

		$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=1");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=1", $this->getLocation());
    }

    public function testIntroductieBekijken()
    {
		$this->login();

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=1");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=1", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Introductie"));
		$this->open("hike_development/index-test.php?r=route/viewIntroductie&event_id=1");
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testRouteBeheren()
    {
		$this->login();

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=1");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=1", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Route Beheren"));
		$this->open("hike_development/index-test.php?r=route/index&event_id=1");
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testPostenBeheren()
    {
		$this->login();

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=1");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=1", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Posten Beheren"));
		$this->open("hike_development/index-test.php?r=posten/index&event_id=1");
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testVragenOverzicht()
    {
		$this->login();

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=1");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=1", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Vragen Overzicht"));
		$this->open("hike_development/index-test.php?r=openVragen/index&event_id=1");
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testHintsOverzicht()
    {
		$this->login();

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=1");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=1", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Hints Overzicht"));
		$this->open("hike_development/index-test.php?r=noodEnvelop/index&event_id=1");
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testStillePostenOverzicht()
    {
		$this->login();

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=1");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=1", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Stille Posten Overzicht"));
		$this->open("hike_development/index-test.php?r=qr/index&event_id=1");
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testDeelnemersToevoegen()
    {
		$this->login();

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=1");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=1", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Deelnemers Toevoegen"));
		$this->open("hike_development/index-test.php?r=deelnemersEvent/create&event_id=1");
        $this->waitForPageToLoad ( "30000" );
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testGroepAanmaken()
    {
		$this->login();

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=1");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=1", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Groep Aanmaken"));
		$this->open("hike_development/index-test.php?r=groups/create&event_id=1");
        $this->waitForPageToLoad ( "30000" );
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testDagVeranderen()
    {
		$this->login();

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=1");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=1", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Dag Veranderen"));
		$this->open("hike_development/index-test.php?r=eventNames/changeDay&event_id=1");
        $this->waitForPageToLoad ( "30000" );
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testStatusVeranderen()
    {
		$this->login();

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=1");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=1", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Status Veranderen"));
		$this->open("hike_development/index-test.php?r=eventNames/changeStatus&event_id=1");
        $this->waitForPageToLoad ( "30000" );
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}
}