<?php

declare(strict_types=1);

namespace ValueObjects\Tests\Climate;

use PHPUnit\Framework\TestCase;
use ValueObjects\Climate\Kelvin;

use function setlocale;

use const LC_ALL;

class KelvinTest extends TestCase
{
    public function setUp(): void
    {
        /**
         * When tests run in a different locale, this might affect the decimal-point character and thus the validation
         * of floats. This makes sure the tests run in a locale that the tests are known to be working in.
         */
        setlocale(LC_ALL, 'en_US.UTF-8');
    }

    /**
     * @return array<array<Kelvin>>
     */
    public function temperatureProvider(): array
    {
        return [[new Kelvin(10)]];
    }

    /**
     * @dataProvider temperatureProvider
     * @param Kelvin $temperature
     */
    public function testToCelsius(
        Kelvin $temperature
    ): void {
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

    /**
     * @dataProvider temperatureProvider
     */
    public function testDifferentLocaleWithDifferentDecimalCharacter(Kelvin $temperature)
    {
        setlocale(LC_ALL, 'de_DE.UTF-8');

        $this->testToCelsius($temperature);
        $this->testToKelvin($temperature);
        $this->testToFahrenheit($temperature);
    }
}
