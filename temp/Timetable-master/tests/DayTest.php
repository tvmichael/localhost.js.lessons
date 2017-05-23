<?php
namespace Jarnstedt\Timetable;

/**
 * Tests for Day class
 */
class DayTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test creating Day object
     */
    public function testCreate()
    {
        $day = new Day(Day::MONDAY);
        $this->assertNotNull($day);
    }

    /**
     * Test static shortcut methods
     */
    public function testShortCut()
    {
        $mon = Day::monday();
        $tue = Day::tuesday();
        $this->assertEquals('Monday', $mon->format('l'));
        $this->assertEquals('Tuesday', $tue->format('l'));
    }

    /**
     * Test changing day
     */
    public function testSetDay()
    {
        $day = new Day(Day::MONDAY);
        $day->setDay(Day::SUNDAY);
        $dayFormatted = $day->format('l');
        $this->assertEquals('Sunday', $dayFormatted);
    }

    /**
     * Test different day formats
     */
    public function testDayFormatting()
    {
        $mon = Day::monday()->format('l');
        $tue = Day::tuesday()->format('l');
        $fri = Day::friday()->format('l');
        $this->assertEquals('Monday', $mon);
        $this->assertEquals('Tuesday', $tue);
        $this->assertEquals('Friday', $fri);
    }

    /**
     * Test day to string conversion
     */
    public function testToString()
    {
        $day = new Day(Day::MONDAY);
        $this->assertEquals('Monday', "$day");
    }

    /**
     * Test invalid day value
     * @expectedException InvalidArgumentException
     */
    public function testInvalidDay()
    {
        new Day(100);
    }
}
