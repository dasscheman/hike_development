<?php
class ActionGestartOrganisatieTest extends WebTestCase
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
		$this->type("id=LoginForm_username", "organisatie");
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

    public function testLoginAndGameOverview()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

		$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=3");
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
    }

    ##Game Overview:
    public function testVragenControleren()
    {
		$scoreVragenBegin = OpenVragenAntwoorden::model()->getOpenVragenScore(3, 5);
		$scoreTotalBegin = Groups::model()->getTotalScoreGroup(3, 5);
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Vragen Controleren"));
		$this->click("link=Vragen Controleren");
		// can be done with: $this->click("//ul[@id='yw2']/li/a/span/i[3]");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=openVragenAntwoorden/viewControle&event_id=3", $this->getLocation());

		$this->open("hike_development/index-test.php?r=openVragenAntwoorden/antwoordGoedOfFout&id=1&goedfout=0&event_id=3");
		$this->waitForPageToLoad ( "30000" );
		$this->open("hike_development/index-test.php?r=openVragenAntwoorden/antwoordGoedOfFout&id=2&goedfout=1&event_id=3");
		$this->waitForPageToLoad ( "30000" );

		$scoreVragenEnd = OpenVragenAntwoorden::model()->getOpenVragenScore(3, 5);
		$scoreTotalEnd = Groups::model()->getTotalScoreGroup(3, 5);
		$this->assertEquals(0, $scoreVragenBegin);
		$this->assertEquals(5, $scoreVragenEnd);
		$this->assertEquals(5, $scoreVragenEnd-$scoreVragenBegin);
		$this->assertEquals(5, $scoreTotalEnd-$scoreTotalBegin);
    }


    public function testBonuspuntenGeven()
    {
		$scoreBonuspuntenBegin = Bonuspunten::model()->getBonuspuntenScore(3, 5);
		$scoreTotalBegin = Groups::model()->getTotalScoreGroup(3, 5);
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Bonuspunten Geven"));
		$this->click("link=Bonuspunten Geven");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=bonuspunten/create&event_id=3", $this->getLocation());
		$this->select("name=Bonuspunten[group_ID]", "label=groep A gestart");
		$this->type("id=Bonuspunten_omschrijving", "bonuspunten group a");
		$this->type("id=Bonuspunten_score", 3);
		$this->click("name=yt0");
		$this->waitForPageToLoad("30000");

		$this->open("hike_development/index-test.php?r=bonuspunten/create&event_id=3", $this->getLocation());
        $this->waitForPageToLoad ( "30000" );
		$this->select("id=Bonuspunten_group_ID", "label=groep B gestart");
		$this->type("id=Bonuspunten_omschrijving", "bonuspunten group b");
		$this->type("id=Bonuspunten_score", 2);
		$this->click("name=yt0");
		$this->waitForPageToLoad("30000");

		$scoreBonuspuntenEnd = Bonuspunten::model()->getBonuspuntenScore(3, 5);
		$scoreTotalEnd = Groups::model()->getTotalScoreGroup(3, 5);
		$this->assertEquals(3, $scoreBonuspuntenEnd-$scoreBonuspuntenBegin);
		$this->assertEquals(3, $scoreTotalEnd-$scoreTotalBegin);
    }

    public function testBeantwoordeVragen()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Beantwoorden Vragen"));
		$this->click("link=Beantwoorden Vragen");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=openVragenAntwoorden/index&event_id=3", $this->getLocation());

		$this->assertContains("Alle beantwoorde vragen", $this->getBodyText());
		$this->assertContains("Hoofdletter b", $this->getBodyText());
		$this->assertContains("Hoofdletter a", $this->getBodyText());    	
	}

    public function testGeopendeHintsBekijken()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Geopende Hints"));
		$this->click("link=Geopende Hints");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=openNoodEnvelop/index&event_id=3", $this->getLocation());

		$this->assertContains("Alle geopende hints", $this->getBodyText());
		$this->assertContains("Hint gestart organisatie", $this->getBodyText());

	}

    public function testBonuspuntenBekijken()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Bonuspunten Overzicht"));
		$this->click("link=Bonuspunten Overzicht");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=bonuspunten/index&event_id=3", $this->getLocation());

		$this->assertContains("Bonuspunten Overzicht", $this->getBodyText());
		$this->assertContains("bonus gestart organisatie", $this->getBodyText());
	}

    public function testGepasserdePostenBekijken()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Gepasserde Posten"));
		$this->click("link=Gepasserde Posten");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=postPassage/index&event_id=3", $this->getLocation());

		$this->assertContains("Gepasserde Posten", $this->getBodyText());
		$this->assertContains("post 3 gestart organisatie START", $this->getBodyText());
		$this->assertContains("post 3 gestart organisatie LUNCH", $this->getBodyText());
		$this->assertContains("post 3 gestart organisatie EIND", $this->getBodyText());
	}

    public function testGecheckteStillePostenBekijken()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Stille Posten"));
		$this->click("link=Stille Posten");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=QrCheck/index&event_id=3", $this->getLocation());

		$this->assertContains("1wDlYLbS8Ws9EutrUMjNv6", $this->getBodyText());
	}

    ## Group Overview
    public function testLoadGroupOverview()
	{
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5", $this->getLocation());
		$this->assertContains("Posten Overzicht", $this->getBodyText());
		$this->assertContains("Te Controleren Vragen", $this->getBodyText());
		$this->assertContains("Geopende Hints", $this->getBodyText());
	}

    public function testPostBinnenkomst()
	{
		$scorePostenBegin = PostPassage::model()->getPostScore(3, 6);
		$scoreTotalBegin = Groups::model()->getTotalScoreGroup(3, 6);
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=6");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=6", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Binnenkomst Post"));
		$this->click("link=Binnenkomst Post");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=postPassage/create&event_id=3&group_id=6", $this->getLocation());

		$this->select("name=PostPassage[post_ID]", "label=post 3 gestart organisatie LUNCH");
		$this->type("name=PostPassage[binnenkomst]", "2015-02-27 12:43");
		$this->click("name=yt0");
		$this->waitForPageToLoad("30000");

		$scorePostenEnd = PostPassage::model()->getPostScore(3, 6);
		$scoreTotalEnd = Groups::model()->getTotalScoreGroup(3, 6);
		$this->assertEquals(13, $scorePostenEnd);
		$this->assertEquals(18, $scoreTotalEnd);
		$this->assertEquals(13, $scorePostenEnd-$scorePostenBegin);
		$this->assertEquals(13, $scoreTotalEnd-$scoreTotalBegin);
	}

	public function testGroupsVragenBekijken()
	{
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Vragen"));
		$this->click("link=Vragen");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=openVragen/viewPlayers&event_id=3&group_id=5", $this->getLocation());

		$this->assertContains("Hoofdletter b", $this->getBodyText());
		$this->assertContains("Hoofdletter a", $this->getBodyText());
	}

	public function testGroupsBeantwoordenVragenBekijken()
	{
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Beantwoorde Vragen"));
		$this->click("link=Beantwoorde Vragen");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=openVragenAntwoorden/viewPlayers&event_id=3&group_id=5", $this->getLocation());

		$this->assertContains("Hoofdletter b", $this->getBodyText());
		$this->assertContains("Hoofdletter a", $this->getBodyText());
	}

	public function testGroupsHintsBekijken()
	{
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Hints"));
		$this->click("link=Hints");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=noodEnvelop/viewPlayers&event_id=3&group_id=5", $this->getLocation());

		$this->assertContains("Hint gestart organisatie", $this->getBodyText());
	}

	public function testGroupsBonuspuntenBekijken()
	{
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Bonuspunten"));
		$this->click("link=Bonuspunten");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=bonuspunten/viewPlayers&event_id=3&group_id=5", $this->getLocation());

		$this->assertContains("bonus gestart organisatie", $this->getBodyText());
	}

	public function testGroupsStillePostenBekijken()
	{
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Stille Posten"));
		$this->click("link=Stille Posten");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=qrCheck/viewPlayers&event_id=3&group_id=5", $this->getLocation());

		$this->assertContains("gestart organisatie", $this->getBodyText());
		$this->assertContains("2014-08-31 14:03:05", $this->getBodyText());
	}
    ## Startup Overview

	public function testLoginAndStartupOverview()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

		$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=3");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=3", $this->getLocation());
    }

    public function testIntroductieBekijken()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=3", $this->getLocation());
		$this->isElementPresent("link=Introductie");
		$this->open("hike_development/index-test.php?r=route/viewIntroductie&event_id=3");
        $this->assertContains("Vraag voor ActionsGestartOrganisatie introductie", $this->getBodyText());
        $this->assertContains("gestart organisatie Introductie", $this->getBodyText());
        $this->assertContains("2wDlYLbS8Ws9EutrUMjNv6", $this->getBodyText());

		$this->assertFalse($this->isElementPresent("link=Introductie Vraag Maken"));
		$this->assertFalse($this->isElementPresent("link=Introductie Stille Post Maken"));

		$this->open("hike_development/index-test.php?r=openVragen/createIntroductie&event_id=3");
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());

		$this->open("hike_development/index-test.php?r=qr/createIntroductie&event_id=3");
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testRouteBeheren()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=3", $this->getLocation());
		$this->isElementPresent("link=Route Beheren");
		$this->open("hike_development/index-test.php?r=route/index&event_id=3");


        $this->assertContains("2015-02-25", $this->getBodyText());
		$this->assertTrue($this->isElementPresent("//a[contains(@href, '#tab_3')]"));
		$this->assertTrue($this->isElementPresent("link=2015-02-25"));
		$this->assertTrue($this->isElementPresent("link=2015-02-26"));
		$this->assertTrue($this->isElementPresent("link=2015-02-27"));
		$this->assertTrue($this->isElementPresent("link=2015-02-28"));
		$this->assertTrue($this->isElementPresent("link=2015-03-01"));
		$this->click("link=2015-02-27");
        $this->assertContains("9 - Homerun", $this->getBodyText());
	}

    public function testPostenBeheren()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=3", $this->getLocation());
		$this->isElementPresent("link=Posten Beheren");
		$this->open("hike_development/index-test.php?r=posten/index&event_id=3");
		$this->assertTrue($this->isElementPresent("link=2015-02-25"));
		$this->assertTrue($this->isElementPresent("link=2015-02-26"));
		$this->assertTrue($this->isElementPresent("link=2015-02-27"));
		$this->assertTrue($this->isElementPresent("link=2015-02-28"));
		$this->assertTrue($this->isElementPresent("link=2015-03-01"));
        $this->assertNotContains("post 3 gestart organisatie START", $this->getBodyText());
        $this->assertNotContains("post 3 gestart organisatie LUNCH", $this->getBodyText());
        $this->assertNotContains("post 3 gestart organisatie EIND", $this->getBodyText());
		$this->click("link=2015-02-27");
        $this->assertContains("post 3 gestart organisatie START", $this->getBodyText());
        $this->assertContains("post 3 gestart organisatie LUNCH", $this->getBodyText());
        $this->assertContains("post 3 gestart organisatie EIND", $this->getBodyText());
		$this->click("link=2015-02-28");
        $this->assertContains("post 1 gestart organisatie test", $this->getBodyText());
        $this->assertContains("post 1 gestart organisatie test", $this->getBodyText());
	}

    public function testVragenOverzicht()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=3", $this->getLocation());
		$this->isElementPresent("link=Vragen Overzicht");
		$this->open("hike_development/index-test.php?r=openVragen/index&event_id=3");
        $this->waitForPageToLoad ( "30000" );
        $this->assertContains("Hoofdletter E", $this->getBodyText());
        $this->assertContains("0000-00-00", $this->getBodyText());
        $this->assertContains("Hoofdletter a", $this->getBodyText());
        $this->assertContains("2015-02-27", $this->getBodyText());
	}

    public function testHintsOverzicht()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=3", $this->getLocation());
		$this->isElementPresent("link=Hints Overzicht");
		$this->open("hike_development/index-test.php?r=noodEnvelop/index&event_id=3");
        $this->waitForPageToLoad ( "30000" );
        $this->assertContains("Hint gestart organisatie", $this->getBodyText());
        $this->assertContains("2015-02-27", $this->getBodyText());
	}

    public function testStillePostenOverzicht()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=3", $this->getLocation());
		$this->isElementPresent("link=Stille Posten Overzicht");
		$this->open("hike_development/index-test.php?r=qr/index&event_id=3");
        $this->waitForPageToLoad ( "30000" );
        $this->assertContains("1wDlYLbS8Ws9EutrUMjNv6", $this->getBodyText());
        $this->assertContains("2wDlYLbS8Ws9EutrUMjNv6", $this->getBodyText());
	}

    public function testDeelnemersToevoegen()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

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

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=3", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Dag Veranderen"));
		$this->open("hike_development/index-test.php?r=eventNames/changeDay&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->type("name=EventNames[max_time]", "label=23:00:00");
		$this->click("name=yt0");
		$this->waitForPageToLoad("30000");

		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
        $this->assertContains("Tijd over (minuten): 724", $this->getBodyText());
        $this->assertContains("Tijd over (minuten): nog niet gestart", $this->getBodyText());

		$this->open("hike_development/index-test.php?r=eventNames/changeDay&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->type("name=EventNames[max_time]", "label=24:00:00");
		$this->click("name=yt0");
		$this->waitForPageToLoad("30000");

		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
        $this->assertContains("Tijd over (minuten): 784", $this->getBodyText());
        $this->assertContains("Tijd over (minuten): nog niet gestart", $this->getBodyText());

		$this->open("hike_development/index-test.php?r=eventNames/changeDay&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->select("name=EventNames[active_day]", "label=2015-02-26");
		$this->click("name=yt0");
		$this->waitForPageToLoad("30000");

		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
        $this->assertNotContains("Tijd over (minuten): 784", $this->getBodyText());
        $this->assertContains("Tijd over (minuten): nog niet gestart", $this->getBodyText());
        $this->assertContains("Status van Hike: Gestart", $this->getBodyText());
        $this->assertContains("Actieve dag: 2015-02-26", $this->getBodyText());

		$this->open("hike_development/index-test.php?r=eventNames/changeDay&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->select("name=EventNames[active_day]", "label=2015-02-27");
		$this->click("name=yt0");
		$this->waitForPageToLoad("30000");

		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
        $this->assertContains("Tijd over (minuten): 784", $this->getBodyText());
        $this->assertContains("Tijd over (minuten): nog niet gestart", $this->getBodyText());
        $this->assertContains("Status van Hike: Gestart", $this->getBodyText());
        $this->assertContains("Actieve dag: 2015-02-27", $this->getBodyText());
	}

    public function testStatusVeranderen()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=startup/startupOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=startup/startupOverview&event_id=3", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Status Veranderen"));
		$this->open("hike_development/index-test.php?r=eventNames/changeStatus&event_id=3");

        $this->waitForPageToLoad ( "30000" );
		$this->select("name=EventNames[status]", "label=Opstart");
		$this->click("name=yt0");
		$this->waitForPageToLoad("30000");

		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
        $this->assertNotContains("Tijd over (minuten): 784", $this->getBodyText());
        $this->assertNotContains("Tijd over (minuten): nog niet gestart", $this->getBodyText());
        $this->assertContains("Status van Hike: Opstart", $this->getBodyText());
        $this->assertNotContains("Actieve dag: 2015-02-27", $this->getBodyText());

		$this->open("hike_development/index-test.php?r=eventNames/changeStatus&event_id=3");

        $this->waitForPageToLoad ( "30000" );
		$this->select("name=EventNames[status]", "label=Gestart");
		$this->click("name=yt0");
		$this->waitForPageToLoad("30000");

		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
        $this->assertContains("Tijd over (minuten): 784", $this->getBodyText());
        $this->assertContains("Tijd over (minuten): nog niet gestart", $this->getBodyText());
        $this->assertContains("Status van Hike: Gestart", $this->getBodyText());
        $this->assertContains("Actieve dag: 2015-02-27", $this->getBodyText());
	}
}