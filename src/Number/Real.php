<?php
declare(strict_types=1);

namespace ValueObjects\Number;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

/**
 * Class Real
 */
class Real implements ValueObjectInterface, NumberInterface
{
    /** @var float */
    protected $value;

    /**
     * Returns a Real object given a PHP native float as parameter.
     *
     * @param float... $number
     *
     * @return static
     */
    public static function fromNative(): ValueObjectInterface
    {
        $value = func_get_arg(0);

        return new static($value);
    }

    /**
     * Returns a Real object given a PHP native float as parameter.
     *
     * @param float $value
     */
    public function __construct($value)
    {
        $value = \filter_var($value, FILTER_VALIDATE_FLOAT);

        if (false === $value) {
            throw new InvalidNativeArgumentException($value, ['float']);
        }

        $this->value = $value;
    }

    /**
     * Returns the native value of the real number
     *
     * @return float
     */
    public function toNative()
    {
        return $this->value;
    }

    /**
     * Tells whether two Real are equal by comparing their values
     *
     * @param  ValueObjectInterface $real
     *
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $real): bool
    {
        if (false === Util::classEquals($this, $real)) {
            return false;
        }
        /** @var NumberInterface $real */
        return $this->toNative() === $real->toNative();
    }

    /**
     * Returns the integer part of the Real number as a Integer
     *
     * @param  RoundingMode $roundingMode Rounding mode of the conversion. Defaults to RoundingMode::HALF_UP.
     *
     * @return Integer
     */
    public function toInteger(RoundingMode $roundingMode = null): Integer
    {
        if (null === $roundingMode) {
            $roundingMode = RoundingMode::HALF_UP();
        }

        /** @var int $integerValue */
        $integerValue = \round($this->toNative(), 0, $roundingMode->toNative());
        $integer = new Integer($integerValue);

        return $integer;
    }

    /**
     * Returns the absolute integer part of the Real number as a Natural
     *
     * @param  RoundingMode $roundingMode Rounding mode of the conversion. Defaults to RoundingMode::HALF_UP.
     *
     * @return Natural
     */
    public function toNatural(RoundingMode $roundingMode = null)
    {
        $integerValue = $this->toInteger($roundingMode)->toNative();
        $naturalValue = \abs($integerValue);
        $natural = new Natural($naturalValue);

        return $natural;
    }

    /**
     * Returns the string representation of the real value
     *
     * @return string
     */
    public function __toString(): string
    {
        return \strval($this->toNative());
    }
}
