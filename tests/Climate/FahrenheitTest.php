<?php
namespace ValueObjects\Tests\Climate;

use ValueObjects\Climate\Fahrenheit;
use PHPUnit\Framework\TestCase;

class FahrenheitTest extends TestCase
{
    public function temperatureProvider()
    {
        return array(array(new Fahrenheit(10)));
    }

    /**
     * @dataProvider temperatureProvider
     */
    public function testToCelsius(Fahrenheit $temperature)
    {
        $this->assertEquals((10 - 32) / 1.8, $temperature->toCelsius()->toNative());
    }

    /**
     * @dataProvider temperatureProvider
     */
    public function testToKelvin(Fahrenheit $temperature)
    {
        $this->assertEquals(
            round($temperature->toCelsius()->toNative() + 273.15, 8),
            round($temperature->toKelvin()->toNative(), 8)
        );
    }

    /**
     * @dataProvider temperatureProvider
     */
    public function testToFahrenheit(Fahrenheit $temperature)
    {
        $this->assertEquals(10, $temperature->toFahrenheit()->toNative());
    }
}
