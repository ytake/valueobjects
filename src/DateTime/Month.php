<?php

namespace ValueObjects\DateTime;

use ValueObjects\Enum\Enum;

class Month extends Enum
{
    const JANUARY   = 'January';
    const FEBRUARY  = 'February';
    const MARCH     = 'March';
    const APRIL     = 'April';
    const MAY       = 'May';
    const JUNE      = 'June';
    const JULY      = 'July';
    const AUGUST    = 'August';
    const SEPTEMBER = 'September';
    const OCTOBER   = 'October';
    const NOVEMBER  = 'November';
    const DECEMBER  = 'December';

    /**
     * Get current Month
     *
     * @return Month
     */
    public static function now()
    {
        $now = new \DateTime('now');

        return static::fromNativeDateTime($now);
    }

    /**
     * Returns Month from a native PHP \DateTime
     *
     * @param  \DateTime $date
     * @return Month
     */
    public static function fromNativeDateTime(\DateTime $date)
    {
        $month = \strtoupper($date->format('F'));

        return static::getByName($month);
    }

    /**
     * Returns a numeric representation of the Month.
     * 1 for January to 12 for December.
     *
     * @return int
     */
    public function getNumericValue()
    {
        return $this->getOrdinal() + 1;
    }
}
