<?php
//require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

class admin_tests extends PHPUnit_Extensions_SeleniumTestCase
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

    public function testLoadPageTwee()
    {
    	$this->open("http://127.0.0.1/index-test.php?r=site/login");
        $this->waitForPageToLoad ( "30000" );
	$this->assertEquals("HIKE-app", $this->getText("css=b"));
    }

    public function testLoadPageDrie()
    {
    	$this->open("http://127.0.0.1/hike_development/index-test.php?r=site/login");
        $this->waitForPageToLoad ( "30000" );
	$this->assertEquals("HIKE-app", $this->getText("css=b"));
    }

    public function testLoadPageVier()
    {
    	$this->open("http://127.0.0.1/hike_development/hike_development/index-test.php?r=site/login");
        $this->waitForPageToLoad ( "30000" );
	$this->assertEquals("HIKE-app", $this->getText("css=b"));
    }
}
?>