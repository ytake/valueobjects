<?php

namespace ValueObjects\Tests\Geography;

use ValueObjects\Geography\Longitude;
use PHPUnit\Framework\TestCase;

class LongitudeTest extends TestCase
{
    public function testValidLongitude()
    {
        $this->assertInstanceOf(Longitude::class, new Longitude(16.555838));
    }

    public function testNormalization()
    {
        $longitude = new Longitude(181);
        $this->assertEquals(-179, $longitude->toNative());
    }

    /** @expectedException \TypeError */
    public function testInvalidLongitude()
    {
        new Longitude('invalid');
    }
}
