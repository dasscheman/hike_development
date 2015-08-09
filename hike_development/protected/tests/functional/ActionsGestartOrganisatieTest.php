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
		$this->assertContains("post 1 gestart organisatie test", $this->getBodyText());
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

		$this->assertContains("Stille Posten Moet nog uitwerken", $this->getBodyText());
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
		$scorePostenBegin = PostPassage::model()->getPostScore(3, 5);
		$scoreTotalBegin = Groups::model()->getTotalScoreGroup(3, 5);
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Binnenkomst Post"));
		$this->click("link=Binnenkomst Post");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=postPassage/create&event_id=3&group_id=5", $this->getLocation());

		$this->select("name=PostPassage[post_ID]", "label=post 2 gestart organisatie test");
		$this->type("name=PostPassage[binnenkomst]", "2015-02-27 12:43");
		$this->click("name=yt0");
		$this->waitForPageToLoad("30000");

		$scorePostenEnd = PostPassage::model()->getPostScore(3, 5);
		$scoreTotalEnd = Groups::model()->getTotalScoreGroup(3, 5);
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

		#uitwerken
		$this->assertTrue(false);
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

		#uitwerken
		$this->assertTrue(false);
	}
    ## Startup Overview
}