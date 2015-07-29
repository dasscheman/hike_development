<?php
class ActionGestartOrganisatieTest extends WebTestCase
{
     public $fixtures=array(
        'users'=>'Users',
    );
    /* call fixture:
     *
    // return the row whose alias is 'sample1' in the `Post` fixture table
    $user = $this->users['sampleOrganisatie'];

    // return the AR instance representing the 'sample1' fixture data row
    $user = $this->users('sampleOrganisatie');
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
	$this->assertContains("HIKE-app*", $this->getBodyText());
    }

    public function testLogin()
    {
	$this->open("hike_development/index-test.php?r=game/gameoverview&event_id=1");
        $this->waitForPageToLoad ( "30000" );
	$this->assertContains("hike_development/index-test.php?r=site/login", $this->getLocation());
	$this->type("id=LoginForm_username", "Organisatie");
	$this->type("id=LoginForm_password", "test");
	$this->click("name=yt0");
	$this->waitForPageToLoad("30000");
	$this->assertContains("hike_development/index-test.php?r=site/login", $this->getLocation());
	$this->assertContains("hike_development/index.php?r=game/gameoverview&event_id=1", $this->getLocation());
    }

    ##Game Overview:
/*    public function testVragenControleren()
    {

    }

    public function testBonuspuntenGeven()
    {
	$this->assertEquals("Dat mag dus niet...", $this->getText("css=div.error"));
    }

    public function testBeantwoordeVragenBekijken()
    {
	$this->assertEquals("Dat mag dus niet...", $this->getText("css=div.error"));
    }

    public function testGeopendeHintsBekijken()
    {
	$this->assertEquals("Dat mag dus niet...", $this->getText("css=div.error"));
    }

    public function testBonuspuntenBekijken()
    {
	$this->assertEquals("Dat mag dus niet...", $this->getText("css=div.error"));
    }

    public function testGepasserdePostenBekijken()
    {
	$this->assertEquals("Dat mag dus niet...", $this->getText("css=div.error"));
    }

    public function testGecheckteStillePostenBekijken()
    {
	$this->assertEquals("Dat mag dus niet...", $this->getText("css=div.error"));
    }*/

    ## Group Overview

    ## Startup Overview
}