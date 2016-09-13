<?php namespace Powerplanetonline\LogViewer\Tests\Providers;

use Powerplanetonline\LogViewer\Providers\CommandsServiceProvider;
use Powerplanetonline\LogViewer\Tests\TestCase;

/**
 * Class     CommandsServiceProviderTest
 *
 * @package  Powerplanetonline\LogViewer\Tests\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CommandsServiceProviderTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var CommandsServiceProvider */
    private $provider;

    /** @var array */
    private $commands = [
        'arcanedev.log-viewer.commands.check',
        'arcanedev.log-viewer.commands.publish',
        'arcanedev.log-viewer.commands.stats',
    ];

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->provider = $this->app->getProvider(
            'Powerplanetonline\\LogViewer\\Providers\\CommandsServiceProvider'
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
    public function it_can_get_provides_list()
    {
        $provided = $this->provider->provides();

        $this->assertCount(count($this->commands), $provided);
        $this->assertEquals($this->commands, $provided);
    }
}
