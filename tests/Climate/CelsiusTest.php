<?php
namespace ValueObjects\Tests\Climate;

use ValueObjects\Climate\Celsius;
use ValueObjects\Tests\TestCase;

class CelsiusTest extends TestCase
{
    public function temperatureProvider()
    {
        return array(array(new Celsius(10)));
    }

    /**
     * @dataProvider temperatureProvider
     */
    public function testToCelsius(Celsius $temperature)
    {
        $this->assertEquals(10, $temperature->toCelsius()->toNative());
    }

    /**
     * @dataProvider temperatureProvider
     */
    public function testToKelvin(Celsius $temperature)
    {
        $this->assertEquals(10 + 273.15, $temperature->toKelvin()->toNative());
    }

    /**
     * @dataProvider temperatureProvider
     */
    public function testToFahrenheit(Celsius $temperature)
    {
        $this->assertEquals(10 * 1.8 + 32, $temperature->toFahrenheit()->toNative());
    }
}
