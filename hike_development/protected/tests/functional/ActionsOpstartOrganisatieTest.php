<?php

class ActionOpstartOrganisatieTest extends WebTestCase
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

		$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=1");
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=1", $this->getLocation());
    }

    ##Game Overview:
    public function testVragenControleren()
    {
		if (Yii::app()->user->isGuest )
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
		if (Yii::app()->user->isGuest )
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
		if (Yii::app()->user->isGuest )
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
		if (Yii::app()->user->isGuest )
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
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=1");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=1", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Bonuspunten Overzicht"));
        $this->waitForPageToLoad ( "30000" );
		$this->open("hike_development/index-test.php?r=bonuspunten/index&event_id=1");
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testGepasserdePostenBekijken()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=1");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=1", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Gepasserde Posten"));
        $this->waitForPageToLoad ( "30000" );
		$this->open("hike_development/index-test.php?r=postPassage/index&event_id=1");
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testGecheckteStillePostenBekijken()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=1");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=1", $this->getLocation());
		$this->assertFalse($this->isElementPresent("link=Stille Posten"));
        $this->waitForPageToLoad ( "30000" );
		$this->open("hike_development/index-test.php?r=QrCheck/index&event_id=1");
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=bonuspunten/create&event_id=3", $this->getLocation());
		$this->select("name=Bonuspunten[group_ID]", "label=groep A gestart");
		$this->type("id=Bonuspunten_omschrijving", "bonuspunten group a");
		$this->type("id=Bonuspunten_score", 6);
		$this->click("name=yt0");
		$this->waitForPageToLoad("30000");

		$this->open("hike_development/index-test.php?r=bonuspunten/create&event_id=3", $this->getLocation());
        $this->waitForPageToLoad ( "30000" );
		$this->select("id=Bonuspunten_group_ID", "label=groep B gestart");
		$this->type("id=Bonuspunten_omschrijving", "bonuspunten group a");
		$this->type("id=Bonuspunten_score", 3);
		$this->click("name=yt0");
		$this->waitForPageToLoad("30000");

		$scoreBonuspuntenEnd = Bonuspunten::model()->getBonuspuntenScore(3, 5);
		$scoreTotalEnd = Groups::model()->getTotalScoreGroup(3, 5);
		$this->assertEquals(5, $scoreBonuspuntenEnd-$scoreBonuspuntenBegin);
		$this->assertEquals(5, $scoreTotalEnd-$scoreTotalBegin);
    }

    ## Group Overview
    public function testLoadGroupOverview()
	{
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=1");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=1", $this->getLocation());
		$this->assertContains("Posten Overzicht", $this->getBodyText());
		$this->assertContains("Te Controleren Vragen", $this->getBodyText());
		$this->assertContains("Geopende Hints", $this->getBodyText());
	}

    public function testPostBinnenkomst()
	{
		$scorePostenBegin = PostPassage::model()->getPostScore(3, 5);
		$scoreTotalBegin = Groups::model()->getTotalScoreGroup(3, 5);
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=1");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=1", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Binnenkomst Post"));
		$this->click("link=Binnenkomst Post");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=postPassage/create&event_id=3&group_id=1", $this->getLocation());

		#uitwerken
		$this->assertTrue(false);

		$scorePostenEnd = PostPassage::model()->getPostScore(3, 5);
		$scoreTotalEnd = Groups::model()->getTotalScoreGroup(3, 5);
		$this->assertEquals(5, $scorePostenEnd-$scorePostenBegin);
		$this->assertEquals(5, $scoreTotalEnd-$scoreTotalBegin);
	}

	public function testGroupsVragenBekijken()
	{
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=1");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=1", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Vragen"));
		$this->click("link=Vragen");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=openVragen/viewPlayers&event_id=3&group_id=1", $this->getLocation());

		#uitwerken
		$this->assertTrue(false);
	}

	public function testGroupsBeantwoordenVragenBekijken()
	{
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=1");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=1", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Beantwoorde Vragen"));
		$this->click("link=Beantwoorde Vragen");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=openVragenAntwoorden/viewPlayers&event_id=3&group_id=1", $this->getLocation());

		#uitwerken
		$this->assertTrue(false);
	}

	public function testGroupsHintsBekijken()
	{
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=1");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=1", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Hints"));
		$this->click("link=Hints");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=noodEnvelop/viewPlayers&event_id=3&group_id=1", $this->getLocation());

		#uitwerken
		$this->assertTrue(false);
	}

	public function testGroupsBonuspuntenBekijken()
	{
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=1");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=1", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Bonuspunten"));
		$this->click("link=Bonuspunten");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=bonuspunten/viewPlayers&event_id=3&group_id=1", $this->getLocation());

		#uitwerken
		$this->assertTrue(false);
	}

	public function testGroupsStillePostenBekijken()
	{
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=1");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=1", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Stille Posten"));
		$this->click("link=Stille Posten");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=qrCheck/viewPlayers&event_id=3&group_id=1", $this->getLocation());

		#uitwerken
		$this->assertTrue(false);
	}

    ## Startup Overview
}