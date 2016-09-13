<?php namespace Powerplanetonline\LogViewer\Tests\Commands;

use Powerplanetonline\LogViewer\Tests\TestCase;

/**
 * Class     CheckCommandTest
 *
 * @package  Powerplanetonline\LogViewer\Tests\Commands
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CheckCommandTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_check()
    {
        $code = $this->artisan('log-viewer:check');

        $this->assertEquals(0, $code);
    }
}
