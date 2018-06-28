<?php
declare(strict_types=1);

namespace ValueObjects\Climate;

/**
 * Class Fahrenheit
 */
class Fahrenheit extends Temperature
{
    /**
     * @return Celsius
     */
    public function toCelsius(): Celsius
    {
        return new Celsius(($this->value - 32) / 1.8);
    }

    /**
     * @return Kelvin
     */
    public function toKelvin(): Kelvin
    {
        return new Kelvin($this->toCelsius()->toNative() + 273.15);
    }

    /**
     * @return Fahrenheit
     */
    public function toFahrenheit(): Fahrenheit
    {
        return new static($this->value);
    }
}
