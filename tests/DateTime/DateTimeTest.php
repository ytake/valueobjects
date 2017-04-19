<?php

namespace ValueObjects\Tests\DateTime;

use ValueObjects\DateTime\Date;
use ValueObjects\DateTime\Hour;
use ValueObjects\DateTime\Minute;
use ValueObjects\DateTime\Month;
use ValueObjects\DateTime\MonthDay;
use ValueObjects\DateTime\Second;
use ValueObjects\DateTime\Time;
use ValueObjects\DateTime\Year;
use ValueObjects\Tests\TestCase;
use ValueObjects\DateTime\DateTime;

class DateTimeTest extends TestCase
{
    public function testFromNative()
    {
        $fromNativeDateTime  = DateTime::fromNative(2013, 'December', 21, 10, 20, 34);
        $constructedDateTime = new DateTime(
                                    new Date(new Year(2013), Month::DECEMBER(), new MonthDay(21)),
                                    new Time(new Hour(10), new Minute(20), new Second(34))
                               );

        $this->assertTrue($fromNativeDateTime->sameValueAs($constructedDateTime));
    }

    public function testFromNativeDateTime()
    {
        $nativeDateTime = new \DateTime();
        $nativeDateTime->setDate(2013, 12, 6)->setTime(20, 50, 10);
        $dateTimeFromNative = DateTime::fromNativeDateTime($nativeDateTime);

        $date = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(6));
        $time = new Time(new Hour(20), new Minute(50), new Second(10));
        $constructedDateTime = new DateTime($date, $time);

        $this->assertTrue($dateTimeFromNative->sameValueAs($constructedDateTime));
    }

    public function testNow()
    {
        $dateTime = DateTime::now();
        $this->assertEquals(date('Y-n-j G:i:s'), \strval($dateTime));
    }

    public function testNullTime()
    {
        $date = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(21));
        $dateTime = new DateTime($date);
        $this->assertTrue(Time::zero()->sameValueAs($dateTime->getTime()));
    }

    public function testSameValueAs()
    {
        $date = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(3));
        $time = new Time(new Hour(20), new Minute(50), new Second(10));

        $date3 = new Date(new Year(2014), Month::MARCH(), new MonthDay(5));
        $time3 = new Time(new Hour(10), new Minute(52), new Second(40));

        $dateTime1 = new DateTime($date, $time);
        $dateTime2 = new DateTime($date, $time);
        $dateTime3 = new DateTime($date3, $time3);

        $this->assertTrue($dateTime1->sameValueAs($dateTime2));
        $this->assertFalse($dateTime1->sameValueAs($dateTime3));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($dateTime1->sameValueAs($mock));
    }

    public function testGetDate()
    {
        $date = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(3));
        $time = new Time(new Hour(20), new Minute(50), new Second(10));
        $dateTime = new DateTime($date, $time);

        $this->assertTrue($date->sameValueAs($dateTime->getDate()));
    }

    public function testGetTime()
    {
        $date = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(3));
        $time = new Time(new Hour(20), new Minute(50), new Second(10));
        $dateTime = new DateTime($date, $time);

        $this->assertTrue($time->sameValueAs($dateTime->getTime()));
    }

    public function testToNativeDateTime()
    {
        $date           = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(3));
        $time           = new Time(new Hour(20), new Minute(50), new Second(10));
        $dateTime       = new DateTime($date, $time);
        $nativeDateTime = \DateTime::createFromFormat('Y-n-j H:i:s', '2013-12-3 20:50:10');

        $this->assertEquals($nativeDateTime, $dateTime->toNativeDateTime());
    }

    public function testToString()
    {
        $date           = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(3));
        $time           = new Time(new Hour(20), new Minute(50), new Second(10));
        $dateTime       = new DateTime($date, $time);

        $this->assertEquals('2013-12-3 20:50:10', $dateTime->__toString());
    }

}
