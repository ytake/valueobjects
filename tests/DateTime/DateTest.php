<?php

declare(strict_types=1);

namespace ValueObjects\Tests\DateTime;

use DateTime;
use PHPUnit\Framework\TestCase;
use ValueObjects\DateTime\Date;
use ValueObjects\DateTime\Exception\InvalidDateException;
use ValueObjects\DateTime\Month;
use ValueObjects\DateTime\MonthDay;
use ValueObjects\DateTime\Year;
use ValueObjects\ValueObjectInterface;

use function strval;

final class DateTest extends TestCase
{
    /**
     * @throws InvalidDateException
     */
    public function testFromNative(): void
    {
        $fromNativeDate = Date::fromNative(2013, 'December', 21);
        $constructedDate = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(21));

        $this->assertTrue($fromNativeDate->sameValueAs($constructedDate));
    }

    /**
     * @throws InvalidDateException
     */
    public function testFromNativeDateTime(): void
    {
        $nativeDate = new DateTime();
        $nativeDate->setDate(2013, 12, 3);
        $dateFromNative = Date::fromNativeDateTime($nativeDate);
        $constructedDate = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(3));

        $this->assertTrue($dateFromNative->sameValueAs($constructedDate));
    }

    /**
     * @throws InvalidDateException
     */
    public function testNow(): void
    {
        $date = Date::now();
        $this->assertEquals(date('Y-n-j'), strval($date));
    }

    /**
     * @throws InvalidDateException
     */
    public function testAlmostValidDateException(): void
    {
        $this->expectException(InvalidDateException::class);
        new Date(new Year(2013), Month::FEBRUARY(), new MonthDay(31));
    }

    /**
     * @throws InvalidDateException
     */
    public function testSameValueAs(): void
    {
        $date1 = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(3));
        $date2 = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(3));
        $date3 = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(5));

        $this->assertTrue($date1->sameValueAs($date2));
        $this->assertFalse($date1->sameValueAs($date3));

        $mock = $this->getMockBuilder(ValueObjectInterface::class)->getMock();
        $this->assertFalse($date1->sameValueAs($mock)); /** @phpstan-ignore-line */
    }

    /**
     * @throws InvalidDateException
     */
    public function testGetYear(): void
    {
        $date = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(3));
        $year = new Year(2013);

        $this->assertTrue($year->sameValueAs($date->getYear()));
    }

    /**
     * @throws InvalidDateException
     */
    public function testGetMonth(): void
    {
        $date = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(3));
        $month = Month::DECEMBER();

        $this->assertTrue($month->sameValueAs($date->getMonth()));
    }

    /**
     * @throws InvalidDateException
     */
    public function testGetDay(): void
    {
        $date = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(3));
        $day = new MonthDay(3);

        $this->assertTrue($day->sameValueAs($date->getDay()));
    }

    /**
     * @throws InvalidDateException
     */
    public function testToNativeDateTime(): void
    {
        $date = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(3));
        $nativeDate = DateTime::createFromFormat('Y-n-j H:i:s', '2013-12-3 00:00:00');

        $this->assertEquals($nativeDate, $date->toNativeDateTime());
    }

    /**
     * @throws InvalidDateException
     */
    public function testToString(): void
    {
        $date = new Date(new Year(2013), Month::DECEMBER(), new MonthDay(3));
        $this->assertEquals('2013-12-3', $date->__toString());
    }
}
