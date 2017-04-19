<?php

namespace ValueObjects\DateTime;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Number\Natural;

class MonthDay extends Natural
{
    const MIN_MONTH_DAY = 1;
    const MAX_MONTH_DAY = 31;

    /**
     * Returns a new MonthDay
     *
     * @param int $value
     */
    public function __construct($value)
    {
        $options = array(
            'options' => array('min_range' => self::MIN_MONTH_DAY, 'max_range' => self::MAX_MONTH_DAY)
        );

        $value = filter_var($value, FILTER_VALIDATE_INT, $options);

        if (false === $value) {
            throw new InvalidNativeArgumentException($value, array('int (>=0, <=31)'));
        }

        parent::__construct($value);
    }

    /**
     * Returns the current month day.
     *
     * @return MonthDay
     */
    public static function now()
    {
        $now      = new \DateTime('now');
        $monthDay = \intval($now->format('j'));

        return new static($monthDay);
    }
}
