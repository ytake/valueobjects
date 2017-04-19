<?php

namespace ValueObjects\Number;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

class Integer extends Real
{
    /**
     * Returns a Integer object given a PHP native int as parameter.
     *
     * @param int $value
     */
    public function __construct($value)
    {
        $value = filter_var($value, FILTER_VALIDATE_INT);

        if (false === $value) {
            throw new InvalidNativeArgumentException($value, array('int'));
        }

        parent::__construct($value);
    }

    /**
     * Tells whether two Integer are equal by comparing their values
     *
     * @param  ValueObjectInterface $integer
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $integer)
    {
        if (false === Util::classEquals($this, $integer)) {
            return false;
        }

        return $this->toNative() === $integer->toNative();
    }

    /**
     * Returns the value of the integer number
     *
     * @return int
     */
    public function toNative()
    {
        $value = parent::toNative();

        return \intval($value);
    }

    /**
     * Returns a Real with the value of the Integer
     *
     * @return Real
     */
    public function toReal()
    {
        $value = $this->toNative();
        $real  = new Real($value);

        return $real;
    }
}
