<?php
namespace Jarnstedt\Timetable;

use Datetime;
use TimeRange\TimeRange;

class Timetable
{
    /**
     * Day data mapping
     * @var array
     */
    protected $dayData = array();

    /**
     * Start of schedule (optional)
     * @var Datetime
     */
    protected $start;

    /**
     * End of schedule (optional)
     * @var Datetime
     */
    protected $end;

    /**
     * Days of the week
     * @var array
     */
    protected $days;

    /**
     * Create a new Timetable instance
     * 
     * @param  array  $openings Opening hours
     */
    public function __construct(array $openings)
    {
        $this->start = null;
        $this->end = null;
        $this->initializeDays();
        $this->addOpenings($openings);
    }

    /**
     * Initialize day data
     */
    private function initializeDays()
    {
        $this->dayData = array(
            Day::MONDAY => array(
                'day' => Day::monday(),
                'openings' => array()
            ),
            Day::TUESDAY => array(
                'day' => Day::tuesday(),
                'openings' => array()
            ),
            Day::WEDNESDAY => array(
                'day' => Day::wednesday(),
                'openings' => array()
            ),
            Day::THURSDAY => array(
                'day' => Day::thursday(),
                'openings' => array()
            ),
            Day::FRIDAY => array(
                'day' => Day::friday(),
                'openings' => array()
            ),
            Day::SATURDAY => array(
                'day' => Day::saturday(),
                'openings' => array()
            ),
            Day::SUNDAY => array(
                'day' => Day::sunday(),
                'openings' => array()
            ),
        );
    }

    /**
     * Add multiple opening hours
     *
     * @param  array  $openings
     */
    public function addOpenings(array $openings)
    {
        foreach ($openings as $opening) {
            $this->addOpening($opening);
        }
    }

    /**
     * Add new opening hour to schedule
     * 
     * @param  OpeningInterface  $opening
     */
    public function addOpening(OpeningInterface $opening)
    {
        $day = new Day($opening->getDay());
        $this->dayData[$day->getNumber()]['openings'][] = $opening;
    }

    /**
     * Get openings for a day
     * 
     * @param   mixed  $day
     * @return  array
     */
    public function getOpenings($day)
    {
        $day = new Day($day);
        return $this->dayData[$day->getNumber()]['openings'];
    }

    /**
     * Returns true if timetable has the given day of week
     *
     * @param DayInterface $day
     * @return bool
     */
    public function hasDay(DayInterface $day)
    {
        if (is_null($this->start) or is_null($this->end)) {
            return true;
        }
        $range = new Timerange($this->start, $this->end);
        foreach ($range->getDays() as $date) {
            if ($date->format('N') == $day->format('N')) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get days of the week
     *
     * @return  array
     */
    public function getDays()
    {
        $days = array();
        foreach ($this->dayData as $data) {
            $days[] = $data['day'];
        }
        return $days;
    }

    /**
     * Set schedules start time
     * 
     * @param  Datetime  $start
     */
    public function setStart(Datetime $start = null)
    {
        $this->start = $start;
    }

    /**
     * Set schedules end time
     * 
     * @param  Datetime  $end
     */
    public function setEnd(Datetime $end = null)
    {
        $this->end = $end;
    }

    /**
     * Get schedules start time
     * 
     * @return Datetime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Get schedules end time
     * 
     * @return Datetime
     */
    public function getEnd()
    {
        return $this->end;
    }

}
