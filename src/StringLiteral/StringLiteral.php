<?php
declare(strict_types=1);

namespace ValueObjects\StringLiteral;

use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

/**
 * Class StringLiteral
 */
class StringLiteral implements ValueObjectInterface
{
    protected $value;

    /**
     * Returns a StringLiteral object given a PHP native string as parameter.
     *
     * @param  ...string $value
     *
     * @return StringLiteral|ValueObjectInterface
     */
    public static function fromNative(): ValueObjectInterface
    {
        $value = func_get_arg(0);

        return new static($value);
    }

    /**
     * Returns a StringLiteral object given a PHP native string as parameter.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * Returns the value of the string
     *
     * @return string
     */
    public function toNative(): string
    {
        return $this->value;
    }

    /**
     * Tells whether two string literals are equal by comparing their values
     *
     * @param  ValueObjectInterface $stringLiteral
     *
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $stringLiteral): bool
    {
        if (false === Util::classEquals($this, $stringLiteral)) {
            return false;
        }

        return $this->toNative() === $stringLiteral->toNative();
    }

    /**
     * Tells whether the StringLiteral is empty
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return \strlen($this->toNative()) == 0;
    }

    /**
     * Returns the string value itself
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->toNative();
    }
}
