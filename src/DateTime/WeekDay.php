<?php
declare(strict_types=1);

namespace ValueObjects\DateTime;

use ValueObjects\Enum\Enum;

/**
 * Class WeekDay
 */
class WeekDay extends Enum
{
    const MONDAY    = 'Monday';
    const TUESDAY   = 'Tuesday';
    const WEDNESDAY = 'Wednesday';
    const THURSDAY  = 'Thursday';
    const FRIDAY    = 'Friday';
    const SATURDAY  = 'Saturday';
    const SUNDAY    = 'Sunday';

    /**
     * Returns the current week day.
     *
     * @return WeekDay
     */
    public static function now(): WeekDay
    {
        return static::fromNativeDateTime(new \DateTime('now'));
    }

    /**
     * Returns a WeekDay from a PHP native \DateTime
     *
     * @param  \DateTime $date
     * @return WeekDay
     */
    public static function fromNativeDateTime(\DateTime $date): WeekDay
    {
        $weekDay = \strtoupper($date->format('l'));

        return static::byName($weekDay);
    }

    /**
     * Returns a numeric representation of the WeekDay.
     * 1 for Monday to 7 for Sunday.
     *
     * @return int
     */
    public function getNumericValue(): int
    {
        return $this->getOrdinal() + 1;
    }
}
