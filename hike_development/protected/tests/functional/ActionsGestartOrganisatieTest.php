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

    public function testTitelControleren()
    {
	$this->open('index-test.php');
        $this->assertTitle('HIKE-app');
    }

    ##Game Overview:
    public function testVragenControleren()
    {
	$this->open('index-test.php');
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