<?php

namespace ValueObjects\Tests\DateTime;

use ValueObjects\DateTime\Month;
use ValueObjects\DateTime\MonthDay;
use ValueObjects\DateTime\Year;
use ValueObjects\Tests\TestCase;
use ValueObjects\DateTime\Date;

class DateTest extends TestCase
{
    public function testFromNative()
    {
        $fromNativeDate  = Date::fromNative(2013, 'December', 21);
        $constructedDate = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(21));

        $this->assertTrue($fromNativeDate->sameValueAs($constructedDate));
    }

    public function testFromNativeDateTime()
    {
        $nativeDate = new \DateTime();
        $nativeDate->setDate(2013, 12, 3);
        $dateFromNative = Date::fromNativeDateTime($nativeDate);
        $constructedDate = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(3));

        $this->assertTrue($dateFromNative->sameValueAs($constructedDate));
    }

    public function testNow()
    {
        $date = Date::now();
        $this->assertEquals(date('Y-n-j'), \strval($date));
    }

    /** @expectedException ValueObjects\DateTime\Exception\InvalidDateException */
    public function testAlmostValidDateException()
    {
        new Date(new Year(2013), Month::FEBRUARY(), new MonthDay(31));
    }

    public function testSameValueAs()
    {
        $date1 = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(3));
        $date2 = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(3));
        $date3 = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(5));

        $this->assertTrue($date1->sameValueAs($date2));
        $this->assertFalse($date1->sameValueAs($date3));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($date1->sameValueAs($mock));
    }

    public function testGetYear()
    {
        $date = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(3));
        $year = new Year(2013);

        $this->assertTrue($year->sameValueAs($date->getYear()));
    }

    public function testGetMonth()
    {
        $date = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(3));
        $month = Month::DECEMBER();

        $this->assertTrue($month->sameValueAs($date->getMonth()));
    }

    public function testGetDay()
    {
        $date = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(3));
        $day  = new MonthDay(3);

        $this->assertTrue($day->sameValueAs($date->getDay()));
    }

    public function testToNativeDateTime()
    {
        $date = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(3));
        $nativeDate = \DateTime::createFromFormat('Y-n-j H:i:s', '2013-12-3 00:00:00');

        $this->assertEquals($nativeDate, $date->toNativeDateTime());
    }

    public function testToString()
    {
        $date = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(3));
        $this->assertEquals('2013-12-3', $date->__toString());
    }

}
