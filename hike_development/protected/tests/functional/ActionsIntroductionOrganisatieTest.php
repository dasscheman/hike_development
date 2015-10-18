<?php

class ActionIntroductionOrganisatieTest extends WebTestCase
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
	 * event_id = 2;
	 * route_id = 3, 4;
	 * group_id = 3, 4;
	 * bonuspunten_id = 4, 5, 6;
	 * openVragen_id = 8, 9;
	 * noodenvelop_id = 5;
	 * qr_id = 5, 6;
	 * post_id = 8, 9;
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
		$this->type("id=LoginForm_username", "organisatie");
		$this->type("id=LoginForm_password", "test");
		$this->check("id=LoginForm_rememberMe");
		$this->click("name=yt0");
		$this->waitForPageToLoad("30000");
		$this->assertContains("hike_development/index-test.php", $this->getLocation());
		$this->assertContains("Gebruikersnaam: organisatie", $this->getBodyText());
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

		$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=2");
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=2", $this->getLocation());
    }

    ##Game Overview:
    public function testVragenControleren()
    {
		$scoreVragenBegin = OpenVragenAntwoorden::model()->getOpenVragenScore(2, 3);
		$scoreTotalBegin = Groups::model()->getTotalScoreGroup(2, 3);

		$this->login();

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=2");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=2", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Vragen Controleren"));
		$this->click("link=Vragen Controleren");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=openVragenAntwoorden/viewControle&event_id=2", $this->getLocation());

		$this->open("hike_development/index-test.php?r=openVragenAntwoorden/antwoordGoedOfFout&id=4&goedfout=0&event_id=2");
		$this->waitForPageToLoad ( "30000" );
		$this->open("hike_development/index-test.php?r=openVragenAntwoorden/antwoordGoedOfFout&id=5&goedfout=1&event_id=2");
		$this->waitForPageToLoad ( "30000" );

		$scoreVragenEnd = OpenVragenAntwoorden::model()->getOpenVragenScore(2, 3);
		$scoreTotalEnd = Groups::model()->getTotalScoreGroup(2, 3);
		$this->assertEquals(0, $scoreVragenBegin);
		$this->assertEquals(5, $scoreVragenEnd);
		$this->assertEquals(5, $scoreVragenEnd-$scoreVragenBegin);
		$this->assertEquals(5, $scoreTotalEnd-$scoreTotalBegin);
    }


    public function testBonuspuntenGeven()
    {
		$scoreBonuspuntenBegin = Bonuspunten::model()->getBonuspuntenScore(2, 3);
		$scoreTotalBegin = Groups::model()->getTotalScoreGroup(2, 3);
		$this->login();

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=2");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=2", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Bonuspunten Geven"));
		$this->click("link=Bonuspunten Geven");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=bonuspunten/create&event_id=2", $this->getLocation());
		$this->select("name=Bonuspunten[group_ID]", "label=groep A introductie");
		$this->type("id=Bonuspunten_omschrijving", "bonuspunten group a");
		$this->type("id=Bonuspunten_score", 3);
		$this->click("name=yt0");
		$this->waitForPageToLoad("30000");

		$this->open("hike_development/index-test.php?r=bonuspunten/create&event_id=2", $this->getLocation());
        $this->waitForPageToLoad ( "30000" );
		$this->select("id=Bonuspunten_group_ID", "label=groep B introductie");
		$this->type("id=Bonuspunten_omschrijving", "bonuspunten group b");
		$this->type("id=Bonuspunten_score", 2);
		$this->click("name=yt0");
		$this->waitForPageToLoad("30000");

		$scoreBonuspuntenEnd = Bonuspunten::model()->getBonuspuntenScore(2, 3);
		$scoreTotalEnd = Groups::model()->getTotalScoreGroup(2, 3);
		$this->assertEquals(3, $scoreBonuspuntenEnd-$scoreBonuspuntenBegin);
		$this->assertEquals(3, $scoreTotalEnd-$scoreTotalBegin);
    }

    public function testBeantwoordeVragen()
    {
		$this->login();

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=2");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=2", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Beantwoorden Vragen"));
		$this->click("link=Beantwoorden Vragen");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=openVragenAntwoorden/index&event_id=2", $this->getLocation());

		$this->assertContains("Alle beantwoorde vragen", $this->getBodyText());
		$this->assertContains("Hoofdletter h", $this->getBodyText());
		$this->assertContains("Hoofdletter i", $this->getBodyText());
	}

    public function testGeopendeHintsBekijken()
    {
		$this->login();

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=2");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=2", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Geopende Hints"));
		$this->open("hike_development/index-test.php?r=openNoodEnvelop/index&event_id=2");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=openNoodEnvelop/index&event_id=2", $this->getLocation());
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());

	}

    public function testBonuspuntenBekijken()
    {
		$this->login();

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=2");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=2", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Bonuspunten Overzicht"));
		$this->click("link=Bonuspunten Overzicht");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=bonuspunten/index&event_id=2", $this->getLocation());

		$this->assertContains("Bonuspunten Overzicht", $this->getBodyText());
		$this->assertContains("bonus intro players groep A", $this->getBodyText());
		$this->assertContains("bonus intro players groep B", $this->getBodyText());
	}

    public function testGepasserdePostenBekijken()
    {
		$this->login();

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=2");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=2", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Gepasserde Posten"));
		$this->open("hike_development/index-test.php?r=postPassage/index&event_id=2");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=postPassage/index&event_id=2", $this->getLocation());
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testGecheckteStillePostenBekijken()
    {
		$this->login();

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=2");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=2", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Stille Posten"));
		$this->click("link=Stille Posten");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=QrCheck/index&event_id=2", $this->getLocation());

		$this->assertContains("introductieintro", $this->getBodyText());
	}

    ## Group Overview
    public function testLoadGroupOverview()
	{
		$this->login();

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=2&group_id=3");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=2&group_id=3", $this->getLocation());
		$this->assertContains("Posten Overzicht", $this->getBodyText());
		$this->assertContains("Te Controleren Vragen", $this->getBodyText());
		$this->assertContains("Geopende Hints", $this->getBodyText());
	}

    public function testPostBinnenkomst()
	{
		$this->login();

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=2&group_id=4");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=2&group_id=4", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Binnenkomst Post"));
		$this->open("hike_development/index-test.php?r=postPassage/create&event_id=2&group_id=4");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=postPassage/create&event_id=2&group_id=4", $this->getLocation());
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

	public function testGroupsVragenBekijken()
	{
		$this->login();

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=2&group_id=3");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=2&group_id=3", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Vragen"));
		$this->click("link=Vragen");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=openVragen/viewPlayers&event_id=2&group_id=3", $this->getLocation());

		$this->assertContains("Hoofdletter h", $this->getBodyText());
		$this->assertContains("Hoofdletter i", $this->getBodyText());
	}

	public function testGroupsBeantwoordenVragenBekijken()
	{
		$this->login();

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=2&group_id=3");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=2&group_id=3", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Beantwoorde Vragen"));
		$this->click("link=Beantwoorde Vragen");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=openVragenAntwoorden/viewPlayers&event_id=2&group_id=3", $this->getLocation());

		$this->assertContains("Hoofdletter h", $this->getBodyText());
	}

	public function testGroupsHintsBekijken()
	{
		$this->login();

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=2&group_id=3");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=2&group_id=3", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Hints"));
		$this->open("hike_development/index-test.php?r=noodEnvelop/viewPlayers&event_id=2&group_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=noodEnvelop/viewPlayers&event_id=2&group_id=3", $this->getLocation());
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

	public function testGroupsBonuspuntenBekijken()
	{
		$this->login();

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=2&group_id=3");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=2&group_id=3", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Bonuspunten"));
		$this->click("link=Bonuspunten");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=bonuspunten/viewPlayers&event_id=2&group_id=3", $this->getLocation());

		$this->assertContains("bonus intro organisatie", $this->getBodyText());
	}

	public function testGroupsStillePostenBekijken()
	{
		$this->login();

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=2&group_id=3");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=2&group_id=3", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Stille Posten"));
		$this->click("link=Stille Posten");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=qrCheck/viewPlayers&event_id=2&group_id=3", $this->getLocation());

		$this->assertContains("introIntroductie", $this->getBodyText());
		$this->assertContains("2014-08-31 14:03:05", $this->getBodyText());
	}
    ## Startup Overview

	public function testLoginAndStartupOverview()
    {
		$this->login();

		$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=2");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=2", $this->getLocation());
    }

    public function testIntroductieBekijken()
    {
		$this->login();

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=2");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=2", $this->getLocation());
		$this->isElementPresent("link=Introductie");
		$this->open("hike_development/index-test.php?r=route/viewIntroductie&event_id=2");
        $this->assertContains("Vraag voor status introductie introvraag", $this->getBodyText());
        $this->assertContains("introIntroductie", $this->getBodyText());
        $this->assertContains("2wDlYLbS8Ws9EutrUMjNv6", $this->getBodyText());

		$this->assertFalse($this->isElementPresent("link=Introductie Vraag Maken"));
		$this->assertFalse($this->isElementPresent("link=Introductie Stille Post Maken"));

		$this->open("hike_development/index-test.php?r=openVragen/createIntroductie&event_id=2");
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());

		$this->open("hike_development/index-test.php?r=qr/createIntroductie&event_id=2");
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testRouteBeheren()
    {
		$this->login();

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=2");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=2", $this->getLocation());
		$this->isElementPresent("link=Route Beheren");
		$this->open("hike_development/index-test.php?r=route/index&event_id=2");

		$this->assertTrue($this->isElementPresent("link=2015-02-25"));
		$this->assertTrue($this->isElementPresent("link=2015-02-26"));
		$this->assertTrue($this->isElementPresent("link=2015-02-27"));
		$this->assertTrue($this->isElementPresent("link=2015-02-28"));
		$this->assertTrue($this->isElementPresent("link=2015-03-01"));
		$this->click("link=2015-02-27");
        $this->assertContains("9 - Homerun", $this->getBodyText());

		$this->assertFalse($this->isElementPresent("link=Nieuw"));
		$this->open("hike_development/index-test.php?r=route/create&event_id=2&date=2015-02-25");
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testPostenBeheren()
    {
		$this->login();

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=2");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=2", $this->getLocation());
		$this->isElementPresent("link=Posten Beheren");
		$this->open("hike_development/index-test.php?r=posten/index&event_id=2");

        $this->assertContains("2015-02-25", $this->getBodyText());
		$this->assertTrue($this->isElementPresent("link=2015-02-25"));
		$this->assertTrue($this->isElementPresent("link=2015-02-26"));
		$this->assertTrue($this->isElementPresent("link=2015-02-27"));
		$this->assertTrue($this->isElementPresent("link=2015-02-28"));
		$this->assertTrue($this->isElementPresent("link=2015-03-01"));
		$this->click("link=2015-02-27");
        $this->assertContains("No results found.", $this->getBodyText());
		$this->click("link=2015-02-28");
        $this->assertContains("post 1 introductie", $this->getBodyText());
        $this->assertContains("post 1 introductie", $this->getBodyText());
	}

    public function testVragenOverzicht()
    {
		$this->login();

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=2");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=2", $this->getLocation());
		$this->isElementPresent("link=Vragen Overzicht");
		$this->open("hike_development/index-test.php?r=openVragen/index&event_id=2");
        $this->waitForPageToLoad ( "30000" );
        $this->assertNotContains("Hoofdletter e", $this->getBodyText());
        $this->assertNotContains("Hoofdletter f", $this->getBodyText());
        $this->assertNotContains("Hoofdletter j", $this->getBodyText());
        $this->assertContains("Hoofdletter h", $this->getBodyText());
        $this->assertContains("Hoofdletter i", $this->getBodyText());
        $this->assertContains("Hoofdletter l", $this->getBodyText());
	}

    public function testHintsOverzicht()
    {
		$this->login();

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=2");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=2", $this->getLocation());
		$this->isElementPresent("link=Hints Overzicht");
		$this->open("hike_development/index-test.php?r=noodEnvelop/index&event_id=2");
        $this->waitForPageToLoad ( "30000" );
        $this->assertContains("Hint intro", $this->getBodyText());
        $this->assertContains("2015-02-27", $this->getBodyText());
	}

    public function testStillePostenOverzicht()
    {
		$this->login();

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=2");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=2", $this->getLocation());
		$this->isElementPresent("link=Stille Posten Overzicht");
		$this->open("hike_development/index-test.php?r=qr/index&event_id=2");
        $this->waitForPageToLoad ( "30000" );
        $this->assertContains("1wDlYLbS8Ws9EutrUMjNv6", $this->getBodyText());
        $this->assertContains("2wDlYLbS8Ws9EutrUMjNv6", $this->getBodyText());
	}

    public function testDeelnemersToevoegen()
    {
		$this->login();

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=2");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=2", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Deelnemers Toevoegen"));
		$this->open("hike_development/index-test.php?r=deelnemersEvent/create&event_id=2");
        $this->waitForPageToLoad ( "30000" );
// TODO        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testGroepAanmaken()
    {
		$this->login();

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=2");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=2", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Groep Aanmaken"));
		$this->open("hike_development/index-test.php?r=groups/create&event_id=2");
        $this->waitForPageToLoad ( "30000" );
        $this->assertNotContains("Dat mag dus niet...", $this->getBodyText());
// TODO aanmaken van een groep nog uitwerken. 
	}

    public function testDagVeranderen()
    {
		$this->login();

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=2");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=2", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Dag Veranderen"));
		$this->open("hike_development/index-test.php?r=eventNames/changeDay&event_id=2");
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());

		$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=2");
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=2", $this->getLocation());
        $this->assertContains("Er is geen maximum tijd voor vandaag", $this->getBodyText());


		$this->open("hike_development/index-test.php?r=eventNames/changeDay&event_id=2");
        $this->waitForPageToLoad ( "30000" );
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());

		$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=2");
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=2", $this->getLocation());
		$this->assertContains("Er is geen maximum tijd voor vandaag", $this->getBodyText());

		$this->open("hike_development/index-test.php?r=eventNames/changeDay&event_id=2");
        $this->waitForPageToLoad ( "30000" );
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());

		$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=2");
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=2", $this->getLocation());
		$this->assertNotContains("Tijd over (minuten): 784", $this->getBodyText());
        $this->assertContains("Er is geen maximum tijd voor vandaag", $this->getBodyText());
	}

    public function testStatusVeranderen()
    {
		$this->login();

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=2");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=2", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Status Veranderen"));
		$this->open("hike_development/index-test.php?r=eventNames/changeStatus&event_id=2");
        $this->waitForPageToLoad ( "30000" );
		$this->select("name=EventNames[status]", "label=Opstart");
		$this->click("name=yt0");
		$this->waitForPageToLoad("30000");

		$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=2");
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=2", $this->getLocation());
		$this->assertNotContains("Tijd over (minuten): 784", $this->getBodyText());
        $this->assertNotContains("Tijd over (minuten): nog niet gestart", $this->getBodyText());
        $this->assertContains("groep A introductie", $this->getBodyText());
        $this->assertContains("groep B introductie", $this->getBodyText());

		$this->open("hike_development/index-test.php?r=eventNames/changeStatus&event_id=2");

        $this->waitForPageToLoad ( "30000" );
		$this->select("name=EventNames[status]", "label=Gestart");
		$this->click("name=yt0");
		$this->waitForPageToLoad("30000");

		$this->assertContains("hike_development/index-test.php?r=eventNames/changeDay&event_id=2", $this->getLocation());
		$this->type("id=active_day", "2015-02-27");
		$this->type("id=EventNames_max_time", "24:00:00");
		$this->click("name=yt0");
		$this->waitForPageToLoad("30000");

		$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=2");
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=2", $this->getLocation());
		$this->assertContains("Laatste post: nvt", $this->getBodyText());
        $this->assertContains("Tijd laatste post: nvt", $this->getBodyText());
        $this->assertContains("nog niet gestart", $this->getBodyText());

		$this->open("hike_development/index-test.php?r=eventNames/changeStatus&event_id=2");
        $this->waitForPageToLoad ( "30000" );
		$this->select("name=EventNames[status]", "label=Introductie");
		$this->click("name=yt0");
		$this->waitForPageToLoad("30000");
		$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=2");
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=2", $this->getLocation());
        $this->assertContains("Status van Hike: Introductie", $this->getBodyText());
        $this->assertContains("Er is geen maximum tijd voor vandaag", $this->getBodyText());
	}
}