<?php
declare(strict_types=1);

namespace ValueObjects\NullValue;

use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

/**
 * Class NullValue
 */
class NullValue implements ValueObjectInterface
{
    /**
     * @throws \BadMethodCallException
     */
    public static function fromNative(): ValueObjectInterface
    {
        throw new \BadMethodCallException('Cannot create a NullValue object via this method.');
    }

    /**
     * Returns a new NullValue object
     *
     * @return NullValue|ValueObjectInterface
     */
    public static function create(): ValueObjectInterface
    {
        return new static();
    }

    /**
     * Tells whether two objects are both NullValue
     * @param  NullValue|ValueObjectInterface $null
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $null): bool
    {
        return Util::classEquals($this, $null);
    }

    /**
     * Returns a string representation of the NullValue object
     *
     * @return string
     */
    public function __toString(): string
    {
        return \strval(null);
    }
}
