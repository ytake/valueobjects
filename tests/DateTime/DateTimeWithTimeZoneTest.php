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
use ValueObjects\DateTime\DateTimeWithTimeZone;
use ValueObjects\DateTime\TimeZone;
use ValueObjects\StringLiteral\StringLiteral;

class DateTimeWithTimeZoneTest extends TestCase
{
    public function testFromNative()
    {
        $fromNativeDateTimeWithTz  = DateTimeWithTimeZone::fromNative(2013, 'December', 21, 10, 20, 34, 'Europe/Madrid');
        $constructedDateTimeWithTz = new DateTimeWithTimeZone(
            new DateTime(
                new Date(new Year(2013), Month::DECEMBER(), new MonthDay(21)),
                new Time(new Hour(10), new Minute(20), new Second(34))
            ),
            new TimeZone(new StringLiteral('Europe/Madrid'))
        );

        $this->assertTrue($fromNativeDateTimeWithTz->sameValueAs($constructedDateTimeWithTz));
    }

    public function testFromNativeDateTime()
    {
        $nativeDateTime = new \DateTime();
        $nativeDateTime->setTimeZone(new \DateTimeZone('Europe/Madrid'))->setDate(2013, 12, 6)->setTime(20, 50, 10);
        $dateTimeWithTzFromNative = DateTimeWithTimeZone::fromNativeDateTime($nativeDateTime);

        $date = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(6));
        $time = new Time(new Hour(20), new Minute(50), new Second(10));
        $timezone = new TimeZone(new StringLiteral('Europe/Madrid'));
        $constructedDateTimeWithTz = new DateTimeWithTimeZone(new DateTime($date, $time), $timezone);

        $this->assertTrue($dateTimeWithTzFromNative->sameValueAs($constructedDateTimeWithTz));
    }

    public function testNow()
    {
        $dateTimeWithTz = DateTimeWithTimeZone::now();
        $this->assertEquals(date('Y-n-j G:i:s e'), \strval($dateTimeWithTz));
    }

    public function testSameValueAs()
    {
        $date = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(3));
        $time = new Time(new Hour(20), new Minute(50), new Second(10));
        $timeZone = new TimeZone(new StringLiteral('Europe/Madrid'));

        $date3 = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(3));
        $time3 = new Time(new Hour(20), new Minute(50), new Second(10));
        $timeZone3 = new TimeZone(new StringLiteral('Europe/London'));

        $dateTimeWithTz1 = new DateTimeWithTimeZone(new DateTime($date, $time), $timeZone);
        $dateTimeWithTz2 = new DateTimeWithTimeZone(new DateTime($date, $time), $timeZone);
        $dateTimeWithTz3 = new DateTimeWithTimeZone(new DateTime($date3, $time3), $timeZone3);

        $this->assertTrue($dateTimeWithTz1->sameValueAs($dateTimeWithTz2));
        $this->assertFalse($dateTimeWithTz1->sameValueAs($dateTimeWithTz3));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($dateTimeWithTz1->sameValueAs($mock));
    }

    public function testSameTimestampAs()
    {
        $date1 = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(3));
        $time1 = new Time(new Hour(20), new Minute(50), new Second(10));
        $timeZone1 = new TimeZone(new StringLiteral('Europe/Madrid'));

        $date2 = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(3));
        $time2 = new Time(new Hour(19), new Minute(50), new Second(10));
        $timeZone2 = new TimeZone(new StringLiteral('Europe/London'));

        $dateTimeWithTz1 = new DateTimeWithTimeZone(new DateTime($date1, $time1), $timeZone1);
        $dateTimeWithTz2 = new DateTimeWithTimeZone(new DateTime($date2, $time2), $timeZone2);

        $this->assertTrue($dateTimeWithTz1->sameTimestampAs($dateTimeWithTz2));
        $this->assertFalse($dateTimeWithTz1->sameValueAs($dateTimeWithTz2));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($dateTimeWithTz1->sameTimestampAs($mock));
    }

    public function testGetDateTime()
    {
        $date = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(3));
        $time = new Time(new Hour(20), new Minute(50), new Second(10));
        $dateTime = new DateTime($date, $time);
        $timeZone = new TimeZone(new StringLiteral('Europe/Madrid'));
        $dateTimeWithTz = new DateTimeWithTimeZone($dateTime, $timeZone);

        $this->assertTrue($dateTime->sameValueAs($dateTimeWithTz->getDateTime()));
    }

    public function testGetTimeZone()
    {
        $date = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(3));
        $time = new Time(new Hour(20), new Minute(50), new Second(10));
        $dateTime = new DateTime($date, $time);
        $timeZone = new TimeZone(new StringLiteral('Europe/Madrid'));
        $dateTimeWithTz = new DateTimeWithTimeZone($dateTime, $timeZone);

        $this->assertTrue($timeZone->sameValueAs($dateTimeWithTz->getTimeZone()));
    }

    public function testToNativeDateTime()
    {
        $date           = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(3));
        $time           = new Time(new Hour(20), new Minute(50), new Second(10));
        $dateTime       = new DateTime($date, $time);
        $timeZone       = new TimeZone(new StringLiteral('Europe/Madrid'));
        $dateTimeWithTz = new DateTimeWithTimeZone($dateTime, $timeZone);
        $nativeDateTime = \DateTime::createFromFormat('Y-n-j H:i:s e', '2013-12-3 20:50:10 Europe/Madrid');

        $this->assertEquals($nativeDateTime, $dateTimeWithTz->toNativeDateTime());
    }

    public function testToString()
    {
        $date           = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(3));
        $time           = new Time(new Hour(20), new Minute(50), new Second(10));
        $dateTime       = new DateTime($date, $time);
        $timeZone       = new TimeZone(new StringLiteral('Europe/Madrid'));
        $dateTimeWithTz = new DateTimeWithTimeZone($dateTime, $timeZone);

        $this->assertEquals('2013-12-3 20:50:10 Europe/Madrid', $dateTimeWithTz->__toString());
    }
}
