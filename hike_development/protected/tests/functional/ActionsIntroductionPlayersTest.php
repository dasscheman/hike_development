<?php

class ActionIntroductionPlayersTest extends WebTestCase
{
	protected function setUp()
    {
        $this->setBrowser('*firefox');
        $this->setBrowserUrl('http://127.0.0.1/');
        $this->shareSession(true);
    }

    ##Game Overview:
    public function testVragenControleren()
    {
	$this->assertEquals("Dat mag dus niet...", $this->getText("css=div.error"));
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
    }
}