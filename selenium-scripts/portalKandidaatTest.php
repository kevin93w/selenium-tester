<?php
//Use composer to insall phpunit-selenium
require '../vendor/autoload.php';
define('BROWSERSTACK_USER', 'kevinwareman2');
define('BROWSERSTACK_KEY', 'gUoLmv8gzDsFrzpeyvqK');
class portalKandidaatTest extends PHPUnit_Extensions_Selenium2TestCase
{
    public static $browsers = array(
        array(
            'browserName' => 'chrome',
            'host' => 'hub.browserstack.com',
            'port' => 80,
            'desiredCapabilities' => array(
                'version' => '30',
                'browserstack.user' => BROWSERSTACK_USER,
                'browserstack.key' => BROWSERSTACK_KEY,
                'os' => 'Windows',
                'os_version' => '8.1'
            )
        )
    );

    protected function setUp()
    {
        parent::setUp();
        $this->setBrowserUrl('http://staging.synerg-e.com/portal');

        $web_driver = RemoteWebDriver::create(
            "http://kevinwareman2:gUoLmv8gzDsFrzpeyvqK@hub.browserstack.com/wd/hub",
            array("platform"=>"WINDOWS", "browserName"=>"firefox")
        );
    }

    public function testLogin()
    {
        //Check of we op de goede website zitten
        $this->url('http://staging.synerg-e.com/portal');
        $this->assertEquals('STAGING | Synerg-e | Inloggen', $this->title());

        //Vul het login formulier in
        $this->url('http://www.google.com/');
        $username = $this->byId('username');
        $username->click();
        $this->keys('r.vanderlinde@e-matcher.com');

        $password = $this->byId('password');
        $password->click();
        $this->keys('c827dc4c');

        //If the new title == E-matcher | Home, login has succeeded
        $this->assertEquals('e-Matcher | Home', $this->title());
    }
}
?>