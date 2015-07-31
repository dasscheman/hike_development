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
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
		$this->assertTrue($this->isElementNotPresent("link=Vragen Controleren"));
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

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
		$this->assertTrue($this->isElementNotPresent("link=Bonuspunten Geven"));
		$this->open("hike_development/index-test.php?r=bonuspunten/create&event_id=3");
		$this->waitForPageToLoad("30000");
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
    }

    public function testBeantwoordeVragenBekijken()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
		$this->assertTrue($this->isElementNotPresent("link=Beantwoorde Vragen"));
		$this->open("hike_development/index-test.php?r=openVragenAntwoorden/index&event_id=3");
        $this->waitForPageToLoad ( "30000" );
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testGeopendeHintsBekijken()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
		$this->assertTrue($this->isElementNotPresent("link=Geopende Hints"));
		$this->open("hike_development/index-test.php?r=openNoodEnvelop/index&event_id=3");
		$this->waitForPageToLoad ( "30000" );
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testBonuspuntenBekijken()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
		$this->assertTrue($this->isElementNotPresent("link=Bonuspunten Overzicht"));
        $this->waitForPageToLoad ( "30000" );
		$this->open("hike_development/index-test.php?r=bonuspunten/index&event_id=3");
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testGepasserdePostenBekijken()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
		$this->assertTrue($this->isElementNotPresent("link=Gepasserde Posten"));
        $this->waitForPageToLoad ( "30000" );
		$this->open("hike_development/index-test.php?r=postPassage/index&event_id=3");
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
	}

    public function testGecheckteStillePostenBekijken()
    {
		if (Yii::app()->user->isGuest )
			$this->login();

    	$this->open("hike_development/index-test.php?r=game/gameOverview&event_id=3");
        $this->waitForPageToLoad ( "30000" );
		$this->assertContains("hike_development/index-test.php?r=game/gameOverview&event_id=3", $this->getLocation());
		$this->assertTrue($this->isElementNotPresent("link=Stille Posten"));
        $this->waitForPageToLoad ( "30000" );
		$this->open("hike_development/index-test.php?r=QrCheck/index&event_id=3");
        $this->assertContains("Dat mag dus niet...", $this->getBodyText());
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
		if (Yii::app()->user->isGuest )
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

		#uitwerken
		$this->assertTrue(false);
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