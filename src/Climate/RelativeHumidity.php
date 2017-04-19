<?php

namespace ValueObjects\Climate;

use ValueObjects\Number\Natural;
use ValueObjects\Exception\InvalidNativeArgumentException;

class RelativeHumidity extends Natural
{
    const MIN = 0;

    const MAX = 100;

    /**
     * Returns a new RelativeHumidity from native int value
     *
     * @param int $value
     * @return RelativeHumidity
     */
    public static function fromNative()
    {
        $value = func_get_arg(0);

        return new static($value);
    }

    /**
     * Returns a new RelativeHumidity object
     *
     * @param int $value
     */
    public function __construct($value)
    {
        $options = array(
            'options' => array('min_range' => self::MIN, 'max_range' => self::MAX)
        );

        $value = filter_var($value, FILTER_VALIDATE_INT, $options);

        if (false === $value) {
            throw new InvalidNativeArgumentException($value, array('int (>=' . self::MIN . ', <=' . self::MAX . ')'));
        }

        parent::__construct($value);
    }
}
