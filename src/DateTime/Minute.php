<?php

namespace ValueObjects\DateTime;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Number\Natural;

class Minute extends Natural
{
    const MIN_MINUTE = 0;

    const MAX_MINUTE = 59;

    /**
     * Returns a new Minute from native int value
     *
     * @param  int    $value
     * @return Minute
     */
    public static function fromNative()
    {
        $value = func_get_arg(0);

        return new static($value);
    }

    /**
     * Returns a new Minute object
     *
     * @param int $value
     */
    public function __construct($value)
    {
        $options = array(
            'options' => array('min_range' => self::MIN_MINUTE, 'max_range' => self::MAX_MINUTE)
        );

        $value = filter_var($value, FILTER_VALIDATE_INT, $options);

        if (false === $value) {
            throw new InvalidNativeArgumentException($value, array('int (>=0, <=59)'));
        }

        parent::__construct($value);
    }

    /**
     * Returns the current minute.
     *
     * @return Minute
     */
    public static function now()
    {
        $now    = new \DateTime('now');
        $minute = \intval($now->format('i'));

        return new static($minute);
    }
}
