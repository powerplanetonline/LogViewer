<?php namespace Powerplanetonline\LogViewer\Tests\Utilities;

use Powerplanetonline\LogViewer\Tests\TestCase;
use Powerplanetonline\LogViewer\Utilities\LogMenu;

/**
 * Class     LogMenuTest
 *
 * @package  Powerplanetonline\LogViewer\Tests\Utilities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LogMenuTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var LogMenu */
    private $menu;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->menu = $this->app['arcanedev.log-viewer.menu'];
    }

    public function tearDown()
    {
        unset($this->menu);

        parent::tearDown();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(
            'Powerplanetonline\\LogViewer\\Utilities\\LogMenu',
            $this->menu
        );
    }

    /** @test */
    public function it_can_make_menu_with_helper()
    {
        $log  = $this->getLog('2015-01-01');

        $menu = log_menu()->make($log);
        // TODO: complete the assertion
    }
}
