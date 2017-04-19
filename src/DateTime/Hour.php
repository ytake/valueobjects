<?php

namespace ValueObjects\DateTime;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Number\Natural;

class Hour extends Natural
{
    const MIN_HOUR = 0;
    const MAX_HOUR = 23;

    /**
     * Returns a new Hour from native int value
     *
     * @param  int  $value
     * @return Hour
     */
    public static function fromNative()
    {
        $value = func_get_arg(0);

        return new static($value);
    }

    /**
     * Returns a new Hour object
     *
     * @param int $value
     */
    public function __construct($value)
    {
        $options = array(
            'options' => array('min_range' => self::MIN_HOUR, 'max_range' => self::MAX_HOUR)
        );

        $value = filter_var($value, FILTER_VALIDATE_INT, $options);

        if (false === $value) {
            throw new InvalidNativeArgumentException($value, array('int (>=0, <=23)'));
        }

        parent::__construct($value);
    }

    /**
     * Returns the current hour.
     *
     * @return Hour
     */
    public static function now()
    {
        $now  = new \DateTime('now');
        $hour = \intval($now->format('G'));

        return new static($hour);
    }
}
