<?php namespace Powerplanetonline\LogViewer\Tests\Providers;

use Powerplanetonline\LogViewer\Providers\UtilitiesServiceProvider;
use Powerplanetonline\LogViewer\Tests\TestCase;
use Powerplanetonline\LogViewer\Contracts;

/**
 * Class     UtilitiesServiceProviderTest
 *
 * @package  Powerplanetonline\LogViewer\Tests\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UtilitiesServiceProviderTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var UtilitiesServiceProvider */
    private $provider;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->provider = $this->app->getProvider(
            \Powerplanetonline\LogViewer\Providers\UtilitiesServiceProvider::class
        );
    }

    public function tearDown()
    {
        unset($this->provider);

        parent::tearDown();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */

    public function it_can_be_instantiated()
    {
        $expectations = [
            \Illuminate\Support\ServiceProvider::class,
            \Arcanedev\Support\ServiceProvider::class,
            \Powerplanetonline\LogViewer\Providers\UtilitiesServiceProvider::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->provider);
        }
    }

    /** @test */
    public function it_can_provides()
    {
        $expected = [
            'arcanedev.log-viewer.levels',
            Contracts\Utilities\LogLevels::class,
            'arcanedev.log-viewer.styler',
            Contracts\Utilities\LogStyler::class,
            'arcanedev.log-viewer.menu',
            Contracts\Utilities\LogMenu::class,
            'arcanedev.log-viewer.filesystem',
            Contracts\Utilities\Filesystem::class,
            'arcanedev.log-viewer.factory',
            Contracts\Utilities\Factory::class,
            'arcanedev.log-viewer.checker',
            Contracts\Utilities\LogChecker::class,
        ];

        $this->assertEquals($expected, $this->provider->provides());
    }
}
