<?php
namespace ValueObjects\Tests\Climate;

use ValueObjects\Climate\Kelvin;
use ValueObjects\Tests\TestCase;

class KelvinTest extends TestCase
{
    public function temperatureProvider()
    {
        return array(array(new Kelvin(10)));
    }

    /**
     * @dataProvider temperatureProvider
     */
    public function testToCelsius(Kelvin $temperature)
    {
        $this->assertEquals(10 - 273.15, $temperature->toCelsius()->toNative());
    }

    /**
     * @dataProvider temperatureProvider
     */
    public function testToKelvin(Kelvin $temperature)
    {
        $this->assertEquals(10, $temperature->toKelvin()->toNative());
    }

    /**
     * @dataProvider temperatureProvider
     */
    public function testToFahrenheit(Kelvin $temperature)
    {
        $this->assertEquals($temperature->toCelsius()->toNative() * 1.8 + 32, $temperature->toFahrenheit()->toNative());
    }
}
