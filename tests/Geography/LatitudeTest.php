<?php

namespace ValueObjects\Tests\Geography;

use ValueObjects\Geography\Latitude;
use ValueObjects\Tests\TestCase;

class LatitudeTest extends TestCase
{
    public function testValidLatitude()
    {
        new Latitude(40.829137);
    }

    public function testNormalization()
    {
        $latitude = new Latitude(91);
        $this->assertEquals(90, $latitude->toNative());
    }

    /** @expectedException ValueObjects\Exception\InvalidNativeArgumentException */
    public function testInvalidLatitude()
    {
        new Latitude('invalid');
    }
}
