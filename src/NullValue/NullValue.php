<?php

namespace ValueObjects\NullValue;

use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

class NullValue implements ValueObjectInterface
{
    /**
     * @throws \BadMethodCallException
     */
    public static function fromNative()
    {
        throw new \BadMethodCallException('Cannot create a NullValue object via this method.');
    }

    /**
     * Returns a new NullValue object
     *
     * @return static
     */
    public static function create()
    {
        return new static();
    }

    /**
     * Tells whether two objects are both NullValue
     * @param  ValueObjectInterface $null
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $null)
    {
        return Util::classEquals($this, $null);
    }

    /**
     * Returns a string representation of the NullValue object
     *
     * @return string
     */
    public function __toString()
    {
        return \strval(null);
    }
}
