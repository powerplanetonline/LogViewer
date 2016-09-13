<?php namespace Powerplanetonline\LogViewer\Tests\Entities;

use Powerplanetonline\LogViewer\Entities\LogEntry;
use Powerplanetonline\LogViewer\Tests\TestCase;

/**
 * Class     LogEntryTest
 *
 * @package  Powerplanetonline\LogViewer\Tests\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LogEntryTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var LogEntry */
    private $entry;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->entry = $this->getRandomLogEntry('2015-01-01');
    }

    public function tearDown()
    {
        unset($this->entry);

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
            'Powerplanetonline\\LogViewer\\Entities\\LogEntry',
            $this->entry
        );
        $this->assertLogEntry('2015-01-01', $this->entry);
    }

    /** @test */
    public function it_can_convert_to_json()
    {
        $this->assertJsonObject($this->entry);
    }

    /** @test */
    public function it_can_check_if_same_level()
    {
        $level = $this->entry->level;

        $this->assertTrue($this->entry->isSameLevel($level));
    }
}
