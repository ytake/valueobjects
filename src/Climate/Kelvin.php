<?php

namespace ValueObjects\Climate;

class Kelvin extends Temperature
{
    /**
     * @return Celsius
     */
    public function toCelsius()
    {
        return new Celsius($this->value - 273.15);
    }

    /**
     * @return Kelvin
     */
    public function toKelvin()
    {
        return new static($this->value);
    }

    /**
     * @return Fahrenheit
     */
    public function toFahrenheit()
    {
        return new Fahrenheit($this->toCelsius()->toNative() * 1.8 + 32);
    }
}
