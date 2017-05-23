<?php
namespace Jarnstedt\Timetable;

interface OpeningInterface
{
    /**
     * Get start time of opening
     * 
     * @return \Datetime
     */
    public function getStartTime();

    /**
     * Get end time of opening
     * 
     * @return \Datetime
     */
    public function getEndTime();

    /**
     * Get day for opening
     * 
     * @return mixed monday|tuesday|wednesday|...
     */
    public function getDay();
}
