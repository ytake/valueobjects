<?php
declare(strict_types=1);

/**
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 * Copyright (c) 2018 Yuuki Takezawa
 */

namespace ValueObjects\Number;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

/**
 * Class Real.
 */
class Real implements ValueObjectInterface, NumberInterface
{
    /** @var float */
    protected $value;

    /**
     * Returns a Real object given a PHP native float as parameter.
     *
     * @param float $value
     */
    public function __construct($value)
    {
        /** @var string $stringValue */
        $stringValue = (string)$value;

        # In some locales the decimal-point character might be different,
        # which can cause filter_var($value, FILTER_VALIDATE_FLOAT) to fail.
        $stringValue = str_replace(',', '.', $stringValue);

        # Only apply the decimal-point character fix if needed, otherwise preserve the old value
        if ($stringValue !== (string)$value) {
            $value = \filter_var($stringValue, FILTER_VALIDATE_FLOAT);
        } else {
            $value = \filter_var($value, FILTER_VALIDATE_FLOAT);
        }

        if (false === $value) {
            throw new InvalidNativeArgumentException($value, ['float']);
        }

        $this->value = $value;
    }

    /**
     * Returns the string representation of the real value.
     *
     * @return string
     */
    public function __toString(): string
    {
        return \strval($this->toNative());
    }

    /**
     * Returns a Real object given a PHP native float as parameter.
     *
     * @param float $number
     *
     * @return static
     */
    public static function fromNative(): ValueObjectInterface
    {
        $value = func_get_arg(0);

        return new static($value);
    }

    /**
     * Returns the native value of the real number.
     *
     * @return float
     */
    public function toNative()
    {
        return $this->value;
    }

    /**
     * Tells whether two Real are equal by comparing their values.
     *
     * @param ValueObjectInterface $real
     *
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $real): bool
    {
        if (false === Util::classEquals($this, $real)) {
            return false;
        }
        /* @var NumberInterface $real */
        return $this->toNative() === $real->toNative();
    }

    /**
     * Returns the integer part of the Real number as a Integer.
     *
     * @param RoundingMode $roundingMode Rounding mode of the conversion. Defaults to RoundingMode::HALF_UP.
     *
     * @return int
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
     * Returns the absolute integer part of the Real number as a Natural.
     *
     * @param RoundingMode $roundingMode Rounding mode of the conversion. Defaults to RoundingMode::HALF_UP.
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
}
