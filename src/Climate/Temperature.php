<?php
declare(strict_types=1);

namespace ValueObjects\Climate;

use ValueObjects\Number\Real;

/**
 * Class Temperature
 */
abstract class Temperature extends Real
{
    /**
     * @return Celsius
     */
    abstract public function toCelsius(): Celsius;

    /**
     * @return Kelvin
     */
    abstract public function toKelvin(): Kelvin;

    /**
     * @return Fahrenheit
     */
    abstract public function toFahrenheit(): Fahrenheit;
}
