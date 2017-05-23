<?php
namespace Jarnstedt\Timetable;

use InvalidArgumentException;

/**
 * Timetable day
 */
class Day implements DayInterface
{
    /**
     * Day constants
     */
    const MONDAY    = 1;
    const TUESDAY   = 2;
    const WEDNESDAY = 3;
    const THURSDAY  = 4;
    const FRIDAY    = 5;
    const SATURDAY  = 6;
    const SUNDAY    = 7;

    /**
     * Names of days of the week
     *
     * @var array
     */
    protected static $days = array(
        self::MONDAY,
        self::TUESDAY,
        self::WEDNESDAY,
        self::THURSDAY,
        self::FRIDAY,
        self::SATURDAY,
        self::SUNDAY
    );

    /**
     * Day number 1-7
     * @var integer
     */
    private $dayNumber;

    /**
     * Construct
     * 
     * @param string $day Week day
     */
    public function __construct($day)
    {
        $this->setDay($day);
    }

    /**
     * Set week day
     * @param mixed $day [description]
     * @throws \InvalidArgumentException
     */
    public function setDay($day)
    {
        if (!is_int($day)) {
            $day = date('N', strtotime($day));
        }
        if (!in_array($day, self::$days)) {
            throw new InvalidArgumentException('Invalid week day');
        }
        $this->dayNumber = $day;
    }

    /**
     * Get week day in wanted format
     * 
     * @param  string  $format
     * @return string
     */
    public function format($format = 'l')
    {
        return date($format, mktime(0, 0, 0, 8, $this->dayNumber, 2011));
    }

    /**
     * Get day number 1-7
     * @return integer
     */
    public function getNumber()
    {
        return $this->dayNumber;
    }

    /**
     * To string transformer
     * 
     * @return  string
     */
    public function __toString()
    {
        return $this->format('l');
    }

    /**
     * Create static shortcuts like Day::monday()
     * 
     * @param   string $name
     * @param   array  $arguments
     * @return  mixed
     */
    public static function __callStatic($name, $arguments)
    {
        switch ($name) {
            case 'monday':
            case 'tuesday':
            case 'wednesday':
            case 'thursday':
            case 'friday':
            case 'saturday':
            case 'sunday':
                return new static($name);
                break;
            default:
                break;
        }
    }

}
