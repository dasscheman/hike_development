<?php
//require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

class admin_tests extends PHPUnit_Extensions_SeleniumTestCase
{
    protected function setUp()
    {
        $this->setBrowser('*firefox');
        $this->setBrowserUrl('http://localhost/');
        $this->shareSession(true);
    }

    public function testLoadPage()
    {
        $this->open('http://localhost/protected/tests/travis/simpleTest.html');
        $this->waitForPageToLoad ( "30000" );
	$this->assertEquals("Dat mag dus niet...", $this->getLocation());
        $this->assertTitle('phpunit selenium test');
    }

    public function testLoadPageTwee()
    {
    	$this->open("http://localhost/index-test.php");
        $this->waitForPageToLoad ( "30000" );
	$this->click("//ul[@id='yw2']/li/a/span/i[2]");
	$this->assertTrue((bool)preg_match('/^[\s\S]*index-test\.php[\s\S]r=site\/login$/',$this->getLocation()));
	$this->assertEquals("HIKE-app", $this->getText("css=b"));
    }

    public function testLoadPageDrie()
    {
    	$this->open("http://localhost/hike_development/index-test.php");
        $this->waitForPageToLoad ( "30000" );
	$this->assertEquals("HIKE-app", $this->getText("css=b"));
    }

    public function testLoadPageVier()
    {
    	$this->open("http://localhost/hike_development/hike_development/index-test.php");
        $this->waitForPageToLoad ( "30000" );
	$this->click("//ul[@id='yw2']/li/a/span/i[2]");
	$this->assertTrue((bool)preg_match('/^[\s\S]*index-test\.php[\s\S]r=site\/login$/',$this->getLocation()));
	$this->assertEquals("HIKE-app", $this->getText("css=b"));
    }



        public function testLoadPageVijf()
    {
    	$this->open("index-test.php");
        $this->waitForPageToLoad ( "30000" );
	$this->click("//ul[@id='yw2']/li/a/span/i[2]");
	$this->assertTrue((bool)preg_match('/^[\s\S]*index-test\.php[\s\S]r=site\/login$/',$this->getLocation()));
	$this->assertEquals("HIKE-app", $this->getText("css=b"));
    }

    public function testLoadPageZes()
    {
    	$this->open("hike_development/index-test.php");
        $this->waitForPageToLoad ( "30000" );
	$this->assertEquals("HIKE-app", $this->getText("css=b"));
    }

    public function testLoadPageZeven()
    {
    	$this->open("hike_development/hike_development/index-test.php");
        $this->waitForPageToLoad ( "30000" );
	$this->click("//ul[@id='yw2']/li/a/span/i[2]");
	$this->assertTrue((bool)preg_match('/^[\s\S]*index-test\.php[\s\S]r=site\/login$/',$this->getLocation()));
	$this->assertEquals("HIKE-app", $this->getText("css=b"));
    }

}
?>