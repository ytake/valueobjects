<?php

namespace ValueObjects\Climate;

class Celsius extends Temperature
{
    /**
     * @return Celsius
     */
    public function toCelsius()
    {
        return new static($this->value);
    }

    /**
     * @return Kelvin
     */
    public function toKelvin()
    {
        return new Kelvin($this->value + 273.15);
    }

    /**
     * @return Fahrenheit
     */
    public function toFahrenheit()
    {
        return new Fahrenheit($this->value * 1.8 + 32);
    }
}
