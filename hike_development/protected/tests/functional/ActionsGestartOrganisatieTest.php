<?php
class ActionGestartOrganisatieTest extends WebTestCase
{
    protected function setUp()
    {
        $this->setBrowser('*firefox');
        $this->setBrowserUrl('http://127.0.0.1/');
        $this->shareSession(true);
    }

    public function testLoadPage()
    {
        $this->open('http://127.0.0.1/protected/tests/travis/simpleTest.html');
        $this->waitForPageToLoad ( "30000" );
	$this->assertEquals("Dat mag dus niet...", $this->getLocation());
        $this->assertTitle('phpunit selenium test');
    }
    /*
    protected function setUp()
    {
        $this->setBrowser('*firefox');
        $this->setBrowserUrl('http://127.0.0.1/');
        $this->shareSession(true);
    }

    public function testLoadPage()
    {
        $this->open('http://127.0.0.1/protected/tests/travis/simpleTest.html');
        $this->waitForPageToLoad ( "30000" );
	$this->assertEquals("Dat mag dus niet...", $this->getLocation());
        $this->assertTitle('phpunit selenium test');
    }

    public function testTitelControleren()
    {
	$this->open("http://127.0.0.1/index-test.php?r=site/login");
        $this->waitForPageToLoad ( "30000" );
	$this->assertEquals("HIKE-app", $this->getText("css=b"));

	$this->open('/site/login');
	$this->type("id=LoginForm_username", "hgese");
	$this->type("id=LoginForm_password", "asdf");
	$this->click("name=yt0");
	$this->waitForPageToLoad("30000");
	$this->assertEquals("/index-test.php?r=site/login", $this->getLocation());
	$this->assertEquals("dasman", $this->getText("css=div.view > b"));
        $this->assertTitle('HIKE-app');
    }

    public function testTitelControlerentwe()
    {
	$this->open("http://127.0.0.1/index-test.php");
        $this->waitForPageToLoad ( "30000" );
	$this->assertEquals("HIKE-app", $this->getText("css=b"));
	$this->open('site/login');
	$this->type("id=LoginForm_username", "hgese");
	$this->type("id=LoginForm_password", "asdf");
	$this->click("name=yt0");
	$this->waitForPageToLoad("30000");
	$this->assertEquals("/index-test.php?r=site/login", $this->getLocation());
	$this->assertEquals("dasman", $this->getText("css=div.view > b"));
        $this->assertTitle('HIKE-app');
    }

    ##Game Overview:
    public function testVragenControleren()
    {
	$this->open("http://127.0.0.1/hike_development/index-test.php");
        $this->waitForPageToLoad ( "30000" );
	$this->assertEquals("HIKE-app", $this->getText("css=b"));
	$this->open('protected/site/login');
	$this->type("id=LoginForm_username", "hgese");
	$this->type("id=LoginForm_password", "asdf");
	$this->click("name=yt0");
	$this->waitForPageToLoad("30000");
	$this->assertEquals("/index-test.php?r=site/login", $this->getLocation());
	$this->assertEquals("Dat mag dus niet...", $this->getLocation());
        $this->assertText('HIKE-app');
    }

        ##Game Overview:
    public function testVragenControlerentweewqwq()
    {

	$this->open("http://127.0.0.1/hike_development/hike_development/index-test.php");
        $this->waitForPageToLoad ( "30000" );
	$this->assertEquals("HIKE-app", $this->getText("css=b"));
	$this->open('hike_development/site/login');
	$this->type("id=LoginForm_username", "hgese");
	$this->type("id=LoginForm_password", "asdf");
	$this->click("name=yt0");
	$this->waitForPageToLoad("30000");
	$this->assertEquals("/index-test.php?r=site/login", $this->getLocation());
	$this->assertEquals("Dat mag dus niet...", $this->getLocation());
        $this->assertText('HIKE-app');
    }


    public function testVragenControlerenTwee()
    {
	$this->open('http://127.0.0.1/hike_development/index-test.php?r=site/login');
        $this->waitForPageToLoad ( "30000" );
	$this->type("id=LoginForm_username", "hgese");
	$this->type("id=LoginForm_password", "asdf");
	$this->click("name=yt0");
	$this->waitForPageToLoad("30000");
	$this->assertEquals("/index-test.php?r=site/login", $this->getLocation());
	$this->assertEquals("Dat mag dus niet...", $this->getLocation());
        $this->assertText('HIKE-app');
    }


    public function testVragenControlerenTweetwee()
    {
	$this->open('http://127.0.0.1/hike_development/hike_development/index-test.php?r=site/login');
        $this->waitForPageToLoad ( "30000" );
	$this->type("id=LoginForm_username", "hgese");
	$this->type("id=LoginForm_password", "asdf");
	$this->click("name=yt0");
	$this->waitForPageToLoad("30000");
	$this->assertEquals("/index-test.php?r=site/login", $this->getLocation());
	$this->assertEquals("Dat mag dus niet...", $this->getLocation());
        $this->assertText('HIKE-app');
    }

    public function testVragenControlerendrier()
    {
	$this->open('http://127.0.0.1/hike_development/protected/site/login');
        $this->waitForPageToLoad ( "30000" );
	$this->type("id=LoginForm_username", "hgese");
	$this->type("id=LoginForm_password", "asdf");
	$this->click("name=yt0");
	$this->waitForPageToLoad("30000");
	$this->assertEquals("/index-test.php?r=site/login", $this->getLocation());
	$this->assertEquals("Dat mag dus niet...", $this->getLocation());
        $this->assertText('HIKE-app');
    }

    public function testVragenControlerenvier()
    {
	$this->open('http://127.0.0.1/hike_development/hike_development/index-test.php?r=site/login');
        $this->waitForPageToLoad ( "30000" );
	$this->type("id=LoginForm_username", "hgese");
	$this->type("id=LoginForm_password", "asdf");
	$this->click("name=yt0");
	$this->waitForPageToLoad("30000");
	$this->assertEquals("/index-test.php?r=site/login", $this->getLocation());
	$this->assertEquals("Dat mag dus niet...", $this->getLocation());
        $this->assertText('HIKE-app');
    }

   /* public function testBonuspuntenGeven()
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