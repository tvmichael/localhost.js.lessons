<?php
namespace Jarnstedt\Timetable;

interface DayInterface {

    /**
     * Get week day in wanted format
     *
     * @param  string  $format
     * @return string
     */
    public function format($format = 'l');
}