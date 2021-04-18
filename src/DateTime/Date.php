<?php

/**
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 * Copyright (c) 2018 Yuuki Takezawa
 */

declare(strict_types=1);

namespace ValueObjects\DateTime;

use DateTime;
use ValueObjects\DateTime\Exception\InvalidDateException;
use ValueObjects\Enum\Enum;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

use function intval;
use function sprintf;

/**
 * Class Date.
 */
class Date implements ValueObjectInterface
{
    /** @var Year */
    protected Year $year;

    /** @var Month&Enum */
    protected Month $month;

    /** @var MonthDay */
    protected MonthDay $day;

    /**
     * Create a new Date.
     *
     * @param Year&ValueObjectInterface $year
     * @param Month&Enum $month
     * @param MonthDay&ValueObjectInterface $day
     *
     * @throws InvalidDateException
     */
    public function __construct(
        Year $year,
        Month $month,
        MonthDay $day
    ) {
        $datetime = DateTime::createFromFormat(
            'Y-F-j',
            sprintf('%d-%s-%d', $year->toNative(), $month, $day->toNative())
        );
        if (!$datetime instanceof DateTime) {
            throw new InvalidDateException($year->toNative(), $month->toNative(), $day->toNative());
        }
        $nativeDateErrors = $datetime::getLastErrors();
        /** @phpstan-ignore-next-line */
        if ($nativeDateErrors['warning_count'] > 0 || $nativeDateErrors['error_count'] > 0) {
            throw new InvalidDateException($year->toNative(), $month->toNative(), $day->toNative());
        }
        $this->year = $year;
        $this->month = $month;
        $this->day = $day;
    }

    /**
     * Returns date as string in format Y-n-j.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->toNativeDateTime()->format('Y-n-j');
    }

    /**
     * Returns a new Date from native year, month and day values.
     *
     * @param int|string ...$args
     * param int    $year
     * param string $month
     * param int    $day
     *
     * @return Date&ValueObjectInterface
     * @throws InvalidDateException
     *
     */
    public static function fromNative(
        ...$args
    ): ValueObjectInterface {
        $args = func_get_args();
        return new self(
            new Year($args[0]),
            Month::fromNative($args[1]), /** @phpstan-ignore-line */
            new MonthDay($args[2])
        );
    }

    /**
     * Returns a new Date from a native PHP \DateTime.
     *
     * @param DateTime $date
     *
     * @return Date&ValueObjectInterface
     * @throws InvalidDateException
     *
     */
    public static function fromNativeDateTime(
        DateTime $date
    ): Date {
        $year = intval($date->format('Y'));
        $month = Month::fromNativeDateTime($date);
        $day = intval($date->format('d'));

        return new self(new Year($year), $month, new MonthDay($day));
    }

    /**
     * Returns current Date.
     *
     * @return Date&ValueObjectInterface
     *
     * @throws InvalidDateException
     */
    public static function now(): Date
    {
        return new self(Year::now(), Month::now(), MonthDay::now());
    }

    /**
     * Tells whether two Date are equal by comparing their values.
     *
     * @param ValueObjectInterface&Date $object
     *
     * @return bool
     */
    public function sameValueAs(
        ValueObjectInterface $object
    ): bool {
        if (false === Util::classEquals($this, $object)) {
            return false;
        }

        return $this->getYear()->sameValueAs($object->getYear())
            && $this->getMonth()->sameValueAs($object->getMonth())
            && $this->getDay()->sameValueAs($object->getDay());
    }

    /**
     * Get year.
     *
     * @return Year
     */
    public function getYear(): Year
    {
        return clone $this->year;
    }

    /**
     * Get month.
     *
     * @return Month
     */
    public function getMonth(): Month
    {
        return $this->month;
    }

    /**
     * Get day.
     *
     * @return MonthDay
     */
    public function getDay(): MonthDay
    {
        return clone $this->day;
    }

    /**
     * Returns a native PHP \DateTime version of the current Date.
     *
     * @return DateTime
     */
    public function toNativeDateTime(): DateTime
    {
        $year = $this->getYear()->toNative();
        $month = $this->getMonth()->getNumericValue();
        $day = $this->getDay()->toNative();

        $date = new DateTime();
        $date->setDate($year, $month, $day);
        $date->setTime(0, 0);

        return $date;
    }
}
