<?php
declare(strict_types=1);

namespace ValueObjects\DateTime;

use ValueObjects\Enum\Enum;

/**
 * Class Month
 * @method static string JANUARY()
 * @method static string FEBRUARY()
 * @method static string MARCH()
 * @method static string APRIL()
 * @method static string MAY()
 * @method static string JUNE()
 * @method static string JULY()
 * @method static string AUGUST()
 * @method static string SEPTEMBER()
 * @method static string OCTOBER()
 * @method static string NOVEMBER()
 * @method static string DECEMBER()
 */
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
    public static function now(): Month
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
    public static function fromNativeDateTime(\DateTime $date): Month
    {
        $month = \strtoupper($date->format('F'));

        return static::byName($month);
    }

    /**
     * Returns a numeric representation of the Month.
     * 1 for January to 12 for December.
     *
     * @return int
     */
    public function getNumericValue(): int
    {
        return $this->getOrdinal() + 1;
    }
}
