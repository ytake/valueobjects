<?php

namespace ValueObjects\Climate;

use ValueObjects\Number\Real;

abstract class Temperature extends Real
{
    /**
     * @return Celsius
     */
    abstract public function toCelsius();

    /**
     * @return Kelvin
     */
    abstract public function toKelvin();

    /**
     * @return Fahrenheit
     */
    abstract public function toFahrenheit();
}
