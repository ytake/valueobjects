<?php

namespace ValueObjects\Structure;

use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

class KeyValuePair implements ValueObjectInterface
{
    /** @var ValueObjectInterface */
    protected $key;

    /** @var ValueObjectInterface */
    protected $value;

    /**
     * Returns a KeyValuePair from native PHP arguments evaluated as strings
     *
     * @param string $key
     * @param string $value
     * @return self
     * @throws \InvalidArgumentException
     */
    public static function fromNative()
    {
        $args = func_get_args();

        if (count($args) != 2) {
            throw new \BadMethodCallException('This methods expects two arguments. One for the key and one for the value.');
        }

        $keyString   = \strval($args[0]);
        $valueString = \strval($args[1]);
        $key   = new StringLiteral($keyString);
        $value = new StringLiteral($valueString);

        return new static($key, $value);
    }

    /**
     * Returns a KeyValuePair
     *
     * @param ValueObjectInterface $key
     * @param ValueObjectInterface $value
     */
    public function __construct(ValueObjectInterface $key, ValueObjectInterface $value)
    {
        $this->key   = $key;
        $this->value = $value;
    }

    /**
     * Tells whether two KeyValuePair are equal
     *
     * @param  ValueObjectInterface $keyValuePair
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $keyValuePair)
    {
        if (false === Util::classEquals($this, $keyValuePair)) {
            return false;
        }

        return $this->getKey()->sameValueAs($keyValuePair->getKey()) && $this->getValue()->sameValueAs($keyValuePair->getValue());
    }

    /**
     * Returns key
     *
     * @return ValueObjectInterface
     */
    public function getKey()
    {
        return clone $this->key;
    }

    /**
     * Returns value
     *
     * @return ValueObjectInterface
     */
    public function getValue()
    {
        return clone $this->value;
    }

    /**
     * Returns a string representation of the KeyValuePair in format "$key => $value"
     *
     * @return string
     */
    public function __toString()
    {
        $string = sprintf('%s => %s', $this->getKey(), $this->getValue());

        return $string;
    }
}
