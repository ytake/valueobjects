<?php

namespace ValueObjects\Tests\Geography;

use ValueObjects\Geography\Ellipsoid;
use ValueObjects\Geography\Coordinate;
use ValueObjects\Geography\Latitude;
use ValueObjects\Geography\Longitude;
use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Tests\TestCase;

class CoordinateTest extends TestCase
{
    /** @var Coordinate */
    protected $coordinate;

    public function setup()
    {
        $this->coordinate = new Coordinate(
            new Latitude(40.829137),
            new Longitude(16.555838)
        );
    }

    public function testNullConstructorEllipsoid()
    {
        $this->assertTrue($this->coordinate->getEllipsoid()->sameValueAs(Ellipsoid::WGS84()));
    }

    public function testFromNative()
    {
        $fromNativeCoordinate = Coordinate::fromNative(40.829137, 16.555838, 'WGS84');
        $this->assertTrue($this->coordinate->sameValueAs($fromNativeCoordinate));
    }

    /** @expectedException \BadMethodCallException */
    public function testInvalidFromNative()
    {
        Coordinate::fromNative(40.829137);
    }

    public function testSameValueAs()
    {
        $coordinate2 = new Coordinate(
            new Latitude(40.829137),
            new Longitude(16.555838)
        );
        $coordinate3 = new Coordinate(
            new Latitude(40.829137),
            new Longitude(16.555838),
            Ellipsoid::WGS60()
        );

        $this->assertTrue($this->coordinate->sameValueAs($coordinate2));
        $this->assertTrue($coordinate2->sameValueAs($this->coordinate));
        $this->assertFalse($this->coordinate->sameValueAs($coordinate3));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($this->coordinate->sameValueAs($mock));
    }

    public function getLatitude()
    {
        $latitude = new Latitude(40.829137);
        $this->assertTrue($this->coordinate->getLatitude()->sameValueAs($latitude));
    }

    public function getLongitude()
    {
        $longitude = new Longitude(16.555838);
        $this->assertTrue($this->coordinate->getLongitude()->sameValueAs($longitude));
    }

    public function getEllipsoid()
    {
        $ellipsoid = Ellipsoid::WGS84();
        $this->assertTrue($this->coordinate->getEllipsoid()->sameValueAs($ellipsoid));
    }

    public function testToDegreesMinutesSeconds()
    {
        $dms = new StringLiteral('40°49′45″N, 16°33′21″E');
        $this->assertTrue($this->coordinate->toDegreesMinutesSeconds()->sameValueAs($dms));
    }

    public function testToDecimalMinutes()
    {
        $dm = new StringLiteral('40 49.74822N, 16 33.35028E');
        $this->assertTrue($this->coordinate->toDecimalMinutes()->sameValueAs($dm));
    }

    public function testToUniversalTransverseMercator()
    {
        $utm = new StringLiteral('33T 631188 4520953');
        $this->assertTrue($this->coordinate->toUniversalTransverseMercator()->sameValueAs($utm));
    }

    public function testDistanceFrom()
    {
        $newYork = new Coordinate(
            new Latitude(41.145556),
            new Longitude(-73.995)
        );

        $distance = $this->coordinate->distanceFrom($newYork);
        $this->assertSame(7609068.4225575, $distance->toNative());
    }

    public function testToString()
    {
        $this->assertSame('40.829137,16.555838', $this->coordinate->__toString());
    }
}
