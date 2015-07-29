<?php

class ActionOpstartOrganisatieTest extends WebTestCase
{

    ##Game Overview:
    public function testVragenControleren()
    {
	$this->open('http://127.0.0.1/');
	$this->assertEquals("Dat mag dus niet...", $this->getText("css=div.error"));
    }

    public function testBonuspuntenGeven()
    {
	$this->open('http://127.0.0.1/');
	$this->assertEquals("Dat mag dus niet...", $this->getText("css=div.error"));
    }

    public function testBeantwoordeVragenBekijken()
    {
	$this->open('http://127.0.0.1/');
	$this->assertEquals("Dat mag dus niet...", $this->getText("css=div.error"));
    }

    public function testGeopendeHintsBekijken()
    {
	$this->open('http://127.0.0.1/');
	$this->assertEquals("Dat mag dus niet...", $this->getText("css=div.error"));
    }

    public function testBonuspuntenBekijken()
    {
	$this->open('http://127.0.0.1/');
	$this->assertEquals("Dat mag dus niet...", $this->getText("css=div.error"));
    }

    public function testGepasserdePostenBekijken()
    {
	$this->open('http://127.0.0.1/');
	$this->assertEquals("Dat mag dus niet...", $this->getText("css=div.error"));
    }

    public function testGecheckteStillePostenBekijken()
    {
	$this->open('http://127.0.0.1/');
	$this->assertEquals("Dat mag dus niet...", $this->getText("css=div.error"));
    }
}