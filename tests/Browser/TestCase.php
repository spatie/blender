<?php

namespace Tests\Browser;

use ArticleSeeder;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use FragmentSeeder;
use Laravel\Dusk\TestCase as BaseTestCase;
use Tests\Concerns\CreatesApplication;
use Tests\Concerns\UsesDatabase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use UsesDatabase;

    public function setUp()
    {
        $this->prepareDatabase(true);

        parent::setUp();

        $this->artisan('migrate');

        $this->artisan('db:seed', ['--class' => ArticleSeeder::class]);
        $this->artisan('db:seed', ['--class' => FragmentSeeder::class]);
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
            'http://localhost:9515',
            DesiredCapabilities::chrome()
        );
    }
}
