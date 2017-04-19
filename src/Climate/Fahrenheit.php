<?php

namespace ValueObjects\Climate;

class Fahrenheit extends Temperature
{
    /**
     * @return Celsius
     */
    public function toCelsius()
    {
        return new Celsius(($this->value - 32) / 1.8);
    }

    /**
     * @return Kelvin
     */
    public function toKelvin()
    {
        return new Kelvin($this->toCelsius()->toNative() + 273.15);
    }

    /**
     * @return Fahrenheit
     */
    public function toFahrenheit()
    {
        return new static($this->value);
    }
}
