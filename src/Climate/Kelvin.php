<?php
declare(strict_types=1);

namespace ValueObjects\Climate;

/**
 * Class Kelvin
 */
class Kelvin extends Temperature
{
    /**
     * @return Celsius
     */
    public function toCelsius(): Celsius
    {
        return new Celsius($this->value - 273.15);
    }

    /**
     * @return Kelvin
     */
    public function toKelvin(): Kelvin
    {
        return new static($this->value);
    }

    /**
     * @return Fahrenheit
     */
    public function toFahrenheit(): Fahrenheit
    {
        return new Fahrenheit($this->toCelsius()->toNative() * 1.8 + 32);
    }
}
