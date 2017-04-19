<?php

namespace ValueObjects\Tests\DateTime;

use ValueObjects\Tests\TestCase;
use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\DateTime\TimeZone;

class TimeZoneTest extends TestCase
{
    public function testFromNative()
    {
        $fromNativeTimeZone  = TimeZone::fromNative('Europe/Madrid');
        $constructedTimeZone = new TimeZone(new StringLiteral('Europe/Madrid'));

        $this->assertTrue($fromNativeTimeZone->sameValueAs($constructedTimeZone));
    }

    public function testFromNativeDateTimeZone()
    {
        $nativeTimeZone = new \DateTimeZone('Europe/Madrid');
        $timeZoneFromNative = TimeZone::fromNativeDateTimeZone($nativeTimeZone);

        $constructedTimeZone = new TimeZone(new StringLiteral('Europe/Madrid'));

        $this->assertTrue($timeZoneFromNative->sameValueAs($constructedTimeZone));
    }

    public function testDefaultTz()
    {
        $timeZone = TimeZone::fromDefault();
        $this->assertEquals(date_default_timezone_get(), \strval($timeZone));
    }

    public function testSameValueAs()
    {
        $timeZone1 = new TimeZone(new StringLiteral('Europe/Madrid'));
        $timeZone2 = new TimeZone(new StringLiteral('Europe/Madrid'));
        $timeZone3 = new TimeZone(new StringLiteral('Europe/Berlin'));

        $this->assertTrue($timeZone1->sameValueAs($timeZone2));
        $this->assertFalse($timeZone1->sameValueAs($timeZone3));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($timeZone1->sameValueAs($mock));
    }

    public function testGetName()
    {
        $name = new StringLiteral('Europe/Madrid');
        $timeZone = new TimeZone($name);

        $this->assertTrue($name->sameValueAs($timeZone->getName()));
    }

    public function testToNativeDateTimeZone()
    {
        $nativeTimeZone = new \DateTimeZone('Europe/Madrid');
        $timeZone = new TimeZone(new StringLiteral('Europe/Madrid'));

        $this->assertEquals($nativeTimeZone, $timeZone->toNativeDateTimeZone());
    }

    public function testToString()
    {
        $timeZone = new TimeZone(new StringLiteral('Europe/Madrid'));

        $this->assertEquals('Europe/Madrid', $timeZone->__toString());
    }

    /**
     * @expectedException \ValueObjects\DateTime\Exception\InvalidTimeZoneException
     */
    public function testExceptionOnInvalidTimeZoneName()
    {
        $timeZone = new TimeZone(new StringLiteral('Mars/Phobos'));
    }
}
