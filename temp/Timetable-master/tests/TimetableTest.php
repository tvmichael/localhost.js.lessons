<?php
namespace Jarnstedt\Timetable;

use DateTime;
use Mockery as m;

/**
 * Tests for Timetable class
 */
class TimetableTest extends \PHPUnit_Framework_TestCase
{

    public function tearDown()
    {
        m::close();
    }

    /**
     * Test creating Timetable object
     */
    public function testCreate()
    {
        $timetable = new Timetable(array());
        $this->assertNotNull($timetable);
    }

    /**
     * Test adding new opening hour
     */
    public function testAddOpening()
    {
        $timetable = new Timetable(array());
        $opening = m::mock('Jarnstedt\Timetable\OpeningInterface');
        $opening->shouldReceive('getDay')->andReturn('monday');
        $timetable->addOpening($opening);

        $mon_openings = $timetable->getOpenings('monday');
        $tue_openings = $timetable->getOpenings('tuesday');
        $this->assertEquals(1, count($mon_openings));
        $this->assertEquals(0, count($tue_openings));
    }

    /**
     * Test adding multiple opening hours
     */
    public function testAddOpenings()
    {
        $timetable = new Timetable(array());
        $opening1 = m::mock('Jarnstedt\Timetable\OpeningInterface');
        $opening2 = m::mock('Jarnstedt\Timetable\OpeningInterface');
        $opening1->shouldReceive('getDay')->andReturn('monday');
        $opening2->shouldReceive('getDay')->andReturn('tuesday');
        $timetable->addOpenings(array($opening1, $opening2));

        $mon_openings = $timetable->getOpenings('monday');
        $tue_openings = $timetable->getOpenings('tuesday');
        $this->assertEquals(1, count($mon_openings));
        $this->assertEquals(1, count($tue_openings));
    }

    /**
     * Test getDays()
     */
    public function testGetDays()
    {
        $timetable = new Timetable(array());
        $days = $timetable->getDays();
        $this->assertEquals(7, count($days));
    }

    /**
     * Test hasDay()
     */
    public function testHasDay()
    {
        $timetable = new Timetable(array());
        $timetable->setStart(new DateTime('2014-01-01')); // Wednesday
        $timetable->setEnd(new DateTime('2014-01-01'));
        $day = m::mock('\Jarnstedt\Timetable\DayInterface');
        $day->shouldReceive('format')->with('N')
            ->andReturn(3);
        $return = $timetable->hasDay($day);

        $this->assertTrue($return);
    }

    /**
     * Test hasDay() with no start/end set
     */
    public function testHasDayWithNoDates()
    {
        $timetable = new Timetable(array());
        $day = m::mock('Jarnstedt\Timetable\DayInterface');
        $return = $timetable->hasDay($day);

        $this->assertTrue($return);
    }

    /**
     *
     */
    public function testHasDayFalse()
    {
        $timetable = new Timetable(array());
        $timetable->setStart(new DateTime('2014-10-14')); // Tuesday
        $timetable->setEnd(new DateTime('2014-10-14'));
        $day = m::mock('\Jarnstedt\Timetable\DayInterface');
        $day->shouldReceive('format')->with('N')->andReturn(1); // Monday
        $return = $timetable->hasDay($day);

        $this->assertFalse($return);
    }

}
