<?php

namespace ValueObjects\Tests\Geography;

use ValueObjects\Geography\Longitude;
use ValueObjects\Tests\TestCase;

class LongitudeTest extends TestCase
{
    public function testValidLongitude()
    {
        new Longitude(16.555838);
    }

    public function testNormalization()
    {
        $longitude = new Longitude(181);
        $this->assertEquals(-179, $longitude->toNative());
    }

    /** @expectedException ValueObjects\Exception\InvalidNativeArgumentException */
    public function testInvalidLongitude()
    {
        new Longitude('invalid');
    }
}
