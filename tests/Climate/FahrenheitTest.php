<?php
namespace ValueObjects\Tests\Climate;

use ValueObjects\Climate\Fahrenheit;
use ValueObjects\Tests\TestCase;

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
        $this->assertEquals($temperature->toCelsius()->toNative() + 273.15, $temperature->toKelvin()->toNative());
    }

    /**
     * @dataProvider temperatureProvider
     */
    public function testToFahrenheit(Fahrenheit $temperature)
    {
        $this->assertEquals(10, $temperature->toFahrenheit()->toNative());
    }
}
