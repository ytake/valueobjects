<?php

namespace ValueObjects\Tests\DateTime;

use ValueObjects\DateTime\Minute;
use ValueObjects\DateTime\Second;
use ValueObjects\DateTime\Hour;
use ValueObjects\Tests\TestCase;
use ValueObjects\DateTime\Time;

class TimeTest extends TestCase
{
    public function testFromNative()
    {
        $fromNativeTime  = Time::fromNative(10, 4, 50);
        $constructedTime = new Time(new Hour(10), new Minute(4), new Second(50));

        $this->assertTrue($fromNativeTime->sameValueAs($constructedTime));
    }

    public function testFromNativeDateTime()
    {
        $nativeTime = new \DateTime();
        $nativeTime->setTime(20, 10, 34);
        $timeFromNative = Time::fromNativeDateTime($nativeTime);
        $constructedTime = new Time(new Hour(20), new Minute(10), new Second(34));

        $this->assertTrue($timeFromNative->sameValueAs($constructedTime));
    }

    public function testNow()
    {
        $time = Time::now();
        $this->assertEquals(date('G:i:s'), \strval($time));
    }

    public function testZero()
    {
        $time = Time::zero();
        $this->assertEquals('0:00:00', \strval($time));
    }

    public function testSameValueAs()
    {
        $time1 = new Time(new Hour(20), new Minute(10), new Second(34));
        $time2 = new Time(new Hour(20), new Minute(10), new Second(34));
        $time3 = new Time(new Hour(20), new Minute(1), new Second(10));

        $this->assertTrue($time1->sameValueAs($time2));
        $this->assertFalse($time1->sameValueAs($time3));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($time1->sameValueAs($mock));
    }

    public function testGetHour()
    {
        $time = new Time(new Hour(20), new Minute(10), new Second(34));
        $hour = new Hour(20);

        $this->assertTrue($hour->sameValueAs($time->getHour()));
    }

    public function testGetMinute()
    {
        $time  = new Time(new Hour(20), new Minute(10), new Second(34));
        $minute = new Minute(10);

        $this->assertTrue($minute->sameValueAs($time->getMinute()));
    }

    public function testGetSecond()
    {
        $time = new Time(new Hour(20), new Minute(10), new Second(34));
        $day  = new Second(34);

        $this->assertTrue($day->sameValueAs($time->getSecond()));
    }

    public function testToNativeDateTime()
    {
        $time = new Time(new Hour(20), new Minute(10), new Second(34));
        $nativeTime = \DateTime::createFromFormat('H:i:s', '20:10:34');

        $this->assertEquals($nativeTime, $time->toNativeDateTime());
    }

    public function testToString()
    {
        $time = new Time(new Hour(20), new Minute(10), new Second(34));
        $this->assertEquals('20:10:34', $time->__toString());
    }

}
