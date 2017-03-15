<?php

namespace Tests\Browser;

use ArticleSeeder;
use FragmentSeeder;
use Tests\Concerns\CreatesApplication;
use Laravel\Dusk\TestCase as BaseTestCase;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Tests\Concerns\UsesMySqlDatabase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use UsesMySqlDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->setUpDatabase(function () {
            $this->artisan('db:seed', ['--class' => ArticleSeeder::class]);
            $this->artisan('db:seed', ['--class' => FragmentSeeder::class]);
        });
    }

    /**
     * Prepare for Dusk test execution.
     *
     * @beforeClass
     * @return void
     */
    public static function prepare()
    {
        static::startChromeDriver();
    }

    /**
     * Create the RemoteWebDriver instance.
     *
     * @return \Facebook\WebDriver\Remote\RemoteWebDriver
     */
    protected function driver()
    {
        return RemoteWebDriver::create(
            'http://localhost:9515', DesiredCapabilities::chrome()
        );
    }
}
