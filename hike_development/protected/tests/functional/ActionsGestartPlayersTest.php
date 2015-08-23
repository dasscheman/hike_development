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
 	 *
	 * DATA:
	 * event_id = 3;
	 * route_id = 5, 6;
	 * group_id = 5, 6;
	 * bonuspunten_id = 1, 2, 3;
	 * openVragen_id = 1, 2, 3, 4, 5;
	 * noodenvelop_id = 1, 2, 3, 4;
	 * qr_id = 1, 2;
	 * post_id = 1, 2, 3, 4, 5;
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
		$this->check("id=LoginForm_rememberMe");
		$this->click("name=yt0");
		$this->waitForPageToLoad("30000");
    }

    public function logout()
    {
		$this->open("hike_development/index-test.php?r=site/logout");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php", $this->getLocation());
    }

    public function testLoadPage()
    {
    	$this->open('hike_development/index-test.php');
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("HIKE-app", $this->getBodyText());
    }

    public function testLoginAndGameOverview()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

		if (Yii::app()->user->name != 'deelnemera') {
			$this->logout();
			$this->login();
		}

		$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=3");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
        $this->assertContains("Tijd over (minuten): 784", $this->getBodyText());
        $this->assertContains("Tijd over (minuten): 1440", $this->getBodyText());
    }

    ##Game Overview:
    public function testVragenControleren()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

		if (Yii::app()->user->name != 'deelnemera') {
			$this->logout();
			$this->login();
		}

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Vragen Controleren"));
		$this->open("hike_development/index-test.php?r=openVragenAntwoorden/viewControle&event_id=3");
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());

        #data aanmaken:
		$this->open("hike_development/index-test.php?r=openVragenAntwoorden/antwoordGoedOfFout&id=>1&goedfout=>0&event_id=>3");
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
		$this->open("hike_development/index-test.php?r=openVragenAntwoorden/antwoordGoedOfFout&id=>2&goedfout=>1&event_id=>3");
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
    }


    public function testBonuspuntenGeven()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

		if (Yii::app()->user->name != 'deelnemera') {
			$this->logout();
			$this->login();
		}

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Bonuspunten Geven"));
		$this->open("hike_development/index-test.php?r=bonuspunten/create&event_id=3");
		$this->waitForPageToLoad("30000");
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
    }

    public function testBeantwoordeVragenBekijken()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

		if (Yii::app()->user->name != 'deelnemera') {
			$this->logout();
			$this->login();
		}

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Beantwoorde Vragen"));
		$this->open("hike_development/index-test.php?r=openVragenAntwoorden/index&event_id=3");
        $this->waitForPageToLoad ( "30000" );
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testGeopendeHintsBekijken()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

		if (Yii::app()->user->name != 'deelnemera') {
			$this->logout();
			$this->login();
		}

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Geopende Hints"));
		$this->open("hike_development/index-test.php?r=openNoodEnvelop/index&event_id=3");
		$this->waitForPageToLoad ( "30000" );
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testBonuspuntenBekijken()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

		if (Yii::app()->user->name != 'deelnemera') {
			$this->logout();
			$this->login();
		}

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Bonuspunten Overzicht"));
		$this->open("hike_development/index-test.php?r=bonuspunten/index&event_id=3");
        $this->waitForPageToLoad ( "30000" );
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testGepasserdePostenBekijken()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

		if (Yii::app()->user->name != 'deelnemera') {
			$this->logout();
			$this->login();
		}

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Gepasserde Posten"));
		$this->open("hike_development/index-test.php?r=postPassage/index&event_id=3");
        $this->waitForPageToLoad ( "30000" );
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testGecheckteStillePostenBekijken()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

		if (Yii::app()->user->name != 'deelnemera') {
			$this->logout();
			$this->login();
		}

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Stille Posten"));
		$this->open("hike_development/index-test.php?r=QrCheck/index&event_id=3");
        $this->waitForPageToLoad ( "30000" );
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    ## Group Overview
    public function testLoadGroupOverview()
	{
		if (Yii::app()->user->isGuest )
			$this->login();

		if (Yii::app()->user->name != 'deelnemera') {
			$this->logout();
			$this->login();
		}

		# bekijken van gegevens van andere groep.
		$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=6");
		$this->waitForPageToLoad ( "30000" );
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());

		# bekijken van gegevens van eigen groep.
    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5", $this->getLocation());
		$this->assertContains("Posten Overzicht", $this->getBodyText());
		$this->assertContains("Te Controleren Vragen", $this->getBodyText());
		$this->assertContains("Geopende Hints", $this->getBodyText());
	}

    public function testPostBinnenkomst()
	{
		if (Yii::app()->user->isGuest )
			$this->login();

		if (Yii::app()->user->name != 'deelnemera') {
			$this->logout();
			$this->login();
		}

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Binnenkomst Post"));
		$this->open("hike_development/index-test.php?r=postPassage/create&event_id=3&group_id=5");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

	public function testGroupsVragenBekijken()
	{
		if (Yii::app()->user->isGuest )
			$this->login();

		if (Yii::app()->user->name != 'deelnemera') {
			$this->logout();
			$this->login();
		}

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Vragen"));
		$this->click("link=Vragen");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=openVragen/viewPlayers&event_id=3&group_id=5", $this->getLocation());

		$this->open("hike_development/index-test.php?r=openVragenAntwoorden/update&event_id=2&group_id=6&vraag_id=1");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("Dat mag dus niet...", $this->getBodyText());

		$this->open("hike_development/index-test.php?r=openVragenAntwoorden/update&event_id=3&group_id=5&vraag_id=1");
        $this->waitForPageToLoad ( "30000" );
		$this->type("name=OpenVragenAntwoorden[antwoord_spelers]", "update A");
		$this->click("name=yt0");

		$this->open("hike_development/index-test.php?r=openVragenAntwoorden/create&event_id=3&group_id=5&vraag_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->type("name=OpenVragenAntwoorden[antwoord_spelers]", "create C");
		$this->click("name=yt0");
		$this->waitForPageToLoad("30000");

		$this->open("hike_development/index-test.php?r=openVragenAntwoorden/viewPlayers&event_id=3&group_id=5");
		$this->assertContains("create C", $this->getBodyText());
		$this->assertContains("update A", $this->getBodyText());
	}

	public function testGroupsBeantwoordenVragenBekijken()
	{
		if (Yii::app()->user->isGuest )
			$this->login();

		if (Yii::app()->user->name != 'deelnemera') {
			$this->logout();
			$this->login();
		}

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Beantwoorde Vragen"));
		$this->click("link=Beantwoorde Vragen");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=openVragenAntwoorden/viewPlayers&event_id=3&group_id=5", $this->getLocation());
		$this->assertContains("Hoofdletter b", $this->getBodyText());
		$this->assertContains("deelnemera", $this->getBodyText());
		$this->assertNotContains("deelnemerb", $this->getBodyText());
	}

	public function testGroupsHintsBekijken()
	{
		$scoreHintBegin = NoodEnvelop::model()->getNoodEnvelopScore(3, 5);
		$scoreTotalBegin = Groups::model()->getTotalScoreGroup(3, 5);

		if (Yii::app()->user->isGuest )
			$this->login();

		if (Yii::app()->user->name != 'deelnemera') {
			$this->logout();
			$this->login();
		}

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Hints"));
		$this->click("link=Hints");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=noodEnvelop/viewPlayers&event_id=3&group_id=5", $this->getLocation());

		$this->assertContains("Hint gestart players", $this->getBodyText());
		$this->assertContains("GEOPEND", $this->getBodyText());
		$this->assertTrue($this->isElementPresent("id=yt0"));
		$this->assertEquals("OPENEN", $this->getValue("id=yt0"));
    	$this->open("hike_development/index-test.php?r=openNoodEnvelop/create&nood_envelop_id=2&event_id=3&group_id=5");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5", $this->getLocation());
		$this->open("hike_development/index-test.php?r=openNoodEnvelop/create&nood_envelop_id=3&event_id=3&group_id=6");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=6", $this->getLocation());
		$this->assertContains("Hint gestart players", $this->getBodyText());
		$this->assertNotContains("Hint gestart players groep B", $this->getBodyText());


		$scoreHintEnd = NoodEnvelop::model()->getNoodEnvelopScore(3, 5);
		$scoreTotalEnd = Groups::model()->getTotalScoreGroup(3, 5);
		$this->assertEquals(0, $scoreHintBegin);
		$this->assertEquals(5, $scoreHintEnd);
		$this->assertEquals(5, $scoreHintEnd-$scoreHintBegin);
		$this->assertEquals(5, $scoreTotalEnd-$scoreTotalBegin);
	}

	public function testGroupsBonuspuntenBekijken()
	{
		if (Yii::app()->user->isGuest )
			$this->login();

		if (Yii::app()->user->name != 'deelnemera') {
			$this->logout();
			$this->login();
		}

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Bonuspunten"));
		$this->click("link=Bonuspunten");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=bonuspunten/viewPlayers&event_id=3&group_id=5", $this->getLocation());
		$this->assertContains("bonus gestart players groep A", $this->getBodyText());
		$this->assertNotContains("bonus gestart players groep B", $this->getBodyText());
	}

	public function testGroupsStillePostenBekijken()
	{
		if (Yii::app()->user->isGuest )
			$this->login();

		if (Yii::app()->user->name != 'deelnemera') {
			$this->logout();
			$this->login();
		}

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Stille Posten"));
		$this->click("link=Stille Posten");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=qrCheck/viewPlayers&event_id=3&group_id=5", $this->getLocation());
		$this->assertContains("gestart organisatie", $this->getBodyText());
	}
    ## Startup Overview
    public function testLoginAndStartupOverview()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

		if (Yii::app()->user->name != 'deelnemera') {
			$this->logout();
			$this->login();
		}

		$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=3");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=3", $this->getLocation());
    }

    public function testIntroductieBekijken()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

		if (Yii::app()->user->name != 'deelnemera') {
			$this->logout();
			$this->login();
		}

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=3", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Introductie"));
		$this->open("hike_development/index-test.php?r=route/viewIntroductie&event_id=3");
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testRouteBeheren()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

		if (Yii::app()->user->name != 'deelnemera') {
			$this->logout();
			$this->login();
		}

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=3", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Route Beheren"));
		$this->open("hike_development/index-test.php?r=route/index&event_id=3");
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testPostenBeheren()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

		if (Yii::app()->user->name != 'deelnemera') {
			$this->logout();
			$this->login();
		}

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=3", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Posten Beheren"));
		$this->open("hike_development/index-test.php?r=posten/index&event_id=3");
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testVragenOverzicht()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

		if (Yii::app()->user->name != 'deelnemera') {
			$this->logout();
			$this->login();
		}

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=3", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Vragen Overzicht"));
		$this->open("hike_development/index-test.php?r=openVragen/index&event_id=3");
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testHintsOverzicht()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

		if (Yii::app()->user->name != 'deelnemera') {
			$this->logout();
			$this->login();
		}

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=3", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Hints Overzicht"));
		$this->open("hike_development/index-test.php?r=noodEnvelop/index&event_id=3");
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testStillePostenOverzicht()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

		if (Yii::app()->user->name != 'deelnemera') {
			$this->logout();
			$this->login();
		}

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=3", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Stille Posten Overzicht"));
		$this->open("hike_development/index-test.php?r=qr/index&event_id=3");
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testDeelnemersToevoegen()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

		if (Yii::app()->user->name != 'deelnemera') {
			$this->logout();
			$this->login();
		}

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=3", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Deelnemers Toevoegen"));
		$this->open("hike_development/index-test.php?r=deelnemersEvent/create&event_id=3");
        $this->waitForPageToLoad ( "30000" );
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testGroepAanmaken()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

		if (Yii::app()->user->name != 'deelnemera') {
			$this->logout();
			$this->login();
		}

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=3", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Groep Aanmaken"));
		$this->open("hike_development/index-test.php?r=groups/create&event_id=3");
        $this->waitForPageToLoad ( "30000" );
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testDagVeranderen()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

		if (Yii::app()->user->name != 'deelnemera') {
			$this->logout();
			$this->login();
		}

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=3", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Dag Veranderen"));
		$this->open("hike_development/index-test.php?r=eventNames/changeDay&event_id=3");
        $this->waitForPageToLoad ( "30000" );
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testStatusVeranderen()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

		if (Yii::app()->user->name != 'deelnemera') {
			$this->logout();
			$this->login();
		}

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=3", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Status Veranderen"));
		$this->open("hike_development/index-test.php?r=eventNames/changeStatus&event_id=3");
        $this->waitForPageToLoad ( "30000" );
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}
}