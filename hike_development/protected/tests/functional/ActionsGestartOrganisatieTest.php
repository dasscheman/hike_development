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
		$this->login();
		$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=3");
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
    }

    ##Game Overview:
    public function testVragenControleren()
    {
		$scoreVragenBegin = OpenVragenAntwoorden::model()->getOpenVragenScore(3, 5);
		$scoreTotalBegin = Groups::model()->getTotalScoreGroup(3, 5);
		$this->login();
    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Vragen Controleren"));
		$this->click("link=Vragen Controleren");
		// can be done with: $this->click("//ul[@id='yw2']/li/a/span/i[3]");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=openVragenAntwoorden/viewControle&event_id=3", $this->getLocation());

		#uitwerken
		$this->assertTrue(false);

		$scoreVragenEnd = OpenVragenAntwoorden::model()->getOpenVragenScore(3, 5);
		$scoreTotalEnd = Groups::model()->getTotalScoreGroup(3, 5);
		$this->assertEquals(5, $scoreVragenEnd-$scoreVragenBegin);
		$this->assertEquals(5, $scoreTotalEnd-$scoreTotalBegin);
    }


    public function testBonuspuntenGeven()
    {
		$scoreBonuspuntenBegin = Bonuspunten::model()->getOpenVragenScore(3, 5);
		$scoreTotalBegin = Groups::model()->getTotalScoreGroup(3, 5);
		$this->login();
    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Bonuspunten Geven"));
		$this->click("link=Bonuspunten Geven");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=bonuspunten/create&event_id=3", $this->getLocation());

		#uitwerken
		$this->assertTrue(false);

		$scoreBonuspuntenEnd = Bonuspunten::model()->getOpenVragenScore(3, 5);
		$scoreTotalEnd = Groups::model()->getTotalScoreGroup(3, 5);
		$this->assertEquals(5, $scoreBonuspuntenEnd-$scoreBonuspuntenBegin);
		$this->assertEquals(5, $scoreTotalEnd-$scoreTotalBegin);
    }

    public function testBeantwoordeVragenBekijken()
    {
		$this->login();
    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Beantwoorde Vragen"));
		$this->click("link=Beantwoorde Vragen");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=openVragenAntwoorden/index&event_id=3", $this->getLocation());

		#uitwerken
		$this->assertTrue(false);

	}

    public function testGeopendeHintsBekijken()
    {
		$this->login();
    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Geopende Hints"));
		$this->click("link=Geopende Hints");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=openNoodEnvelop/index&event_id=3", $this->getLocation());

		#uitwerken
		$this->assertTrue(false);

	}

    public function testBonuspuntenBekijken()
    {
		$this->login();
    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Bonuspunten Overzicht"));
		$this->click("link=Bonuspunten Overzicht");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=bonuspunten/index&event_id=3", $this->getLocation());


		#uitwerken
		$this->assertTrue(false);
	}

    public function testGepasserdePostenBekijken()
    {
		$this->login();
    	$this->open("hike_development/index-test.php?r=game/gameoverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Gepasserde Posten"));
		$this->click("link=Gepasserde Posten");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=postPassage/index&event_id=3", $this->getLocation());


		#uitwerken
		$this->assertTrue(false);
	}

    public function testGecheckteStillePostenBekijken()
    {
		$this->login();
    	$this->open("hike_development/index-test.php?r=game/gameoverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Stille Posten"));
		$this->click("link=Stille Posten");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=QrCheck/index&event_id=3", $this->getLocation());

		#uitwerken
		$this->assertTrue(false);

	}

    ## Group Overview
    public function testLoadGroupOverview()
	{
		$this->login();
    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5", $this->getLocation());
	}

    public function testPostBinnenkomst()
	{
		$scorePostenBegin = PostPassage::model()->getPostScore(3, 5);
		$scoreTotalBegin = Groups::model()->getTotalScoreGroup(3, 5);
		$this->login();
    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Binnenkomst Post"));
		$this->click("link=Binnenkomst Post");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=postPassage/create&event_id=3&group_id=5", $this->getLocation());

		#uitwerken
		$this->assertTrue(false);

		$scorePostenEnd = PostPassage::model()->getPostScore(3, 5);
		$scoreTotalEnd = Groups::model()->getTotalScoreGroup(3, 5);
		$this->assertEquals(5, $scorePostenEnd-$scorePostenBegin);
		$this->assertEquals(5, $scoreTotalEnd-$scoreTotalBegin);
	}

	public function testGroupsVragenBekijken()
	{
		$this->login();
    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Vragen"));
		$this->click("link=Vragen");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=openVragen/viewPlayers&event_id=3&group_id=5", $this->getLocation());

		#uitwerken
		$this->assertTrue(false);
	}

	public function testGroupsBeantwoordenVragenBekijken()
	{
		$this->login();
    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Beantwoorde Vragen"));
		$this->click("link=Beantwoorde Vragen");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=openVragenAntwoorden/viewPlayers&event_id=3&group_id=5", $this->getLocation());

		#uitwerken
		$this->assertTrue(false);
	}

	public function testGroupsHintsBekijken()
	{
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
		$this->login();
    	$this->open("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5");
		$this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/groupOverview&event_id=3&group_id=5", $this->getLocation());
		$this->assertTrue($this->isElementPresent("link=Bonuspunten"));
		$this->click("link=Bonuspunten");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=bonuspunten/viewPlayers&event_id=3&group_id=5", $this->getLocation());

		#uitwerken
		$this->assertTrue(false);
	}

	public function testGroupsStillePostenBekijken()
	{
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