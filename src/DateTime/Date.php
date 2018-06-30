<?php
declare(strict_types=1);

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

namespace ValueObjects\DateTime;

use ValueObjects\DateTime\Exception\InvalidDateException;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

/**
 * Class Date.
 */
class Date implements ValueObjectInterface
{
    /** @var Year */
    protected $year;

    /** @var Month */
    protected $month;

    /** @var MonthDay */
    protected $day;

    /**
     * Create a new Date.
     *
     * @param Year     $year
     * @param Month    $month
     * @param MonthDay $day
     *
     * @throws InvalidDateException
     */
    public function __construct(Year $year, Month $month, MonthDay $day)
    {
        \DateTime::createFromFormat('Y-F-j', \sprintf('%d-%s-%d', $year->toNative(), $month, $day->toNative()));
        $nativeDateErrors = \DateTime::getLastErrors();

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
     * @param int    $year
     * @param string $month
     * @param int    $day
     *
     * @throws InvalidDateException
     *
     * @return Date|ValueObjectInterface
     */
    public static function fromNative(): ValueObjectInterface
    {
        $args = func_get_args();

        return new static(
            new Year($args[0]),
            Month::fromNative($args[1]),
            new MonthDay($args[2])
        );
    }

    /**
     * Returns a new Date from a native PHP \DateTime.
     *
     * @param \DateTime $date
     *
     * @throws InvalidDateException
     *
     * @return Date
     */
    public static function fromNativeDateTime(\DateTime $date): Date
    {
        $year = \intval($date->format('Y'));
        $month = Month::fromNativeDateTime($date);
        $day = \intval($date->format('d'));

        return new static(new Year($year), $month, new MonthDay($day));
    }

    /**
     * Returns current Date.
     *
     * @throws InvalidDateException
     *
     * @return Date
     */
    public static function now(): Date
    {
        return new static(Year::now(), Month::now(), MonthDay::now());
    }

    /**
     * Tells whether two Date are equal by comparing their values.
     *
     * @param ValueObjectInterface|Date $date
     *
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $date): bool
    {
        if (false === Util::classEquals($this, $date)) {
            return false;
        }

        return $this->getYear()->sameValueAs($date->getYear()) &&
            $this->getMonth()->sameValueAs($date->getMonth()) &&
            $this->getDay()->sameValueAs($date->getDay());
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
     * @return \DateTime
     */
    public function toNativeDateTime(): \DateTime
    {
        $year = $this->getYear()->toNative();
        $month = $this->getMonth()->getNumericValue();
        $day = $this->getDay()->toNative();

        $date = new \DateTime();
        $date->setDate($year, $month, $day);
        $date->setTime(0, 0, 0);

        return $date;
    }
}
