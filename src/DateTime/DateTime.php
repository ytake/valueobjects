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

use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

class DateTime implements ValueObjectInterface
{
    /** @var Date */
    protected $date;

    /** @var Time */
    protected $time;

    /**
     * Returns a new DateTime object.
     *
     * @param Date $date
     * @param Time $time
     */
    public function __construct(Date $date, Time $time = null)
    {
        $this->date = $date;
        if (null === $time) {
            $time = Time::zero();
        }
        $this->time = $time;
    }

    /**
     * Returns DateTime as string in format "Y-n-j G:i:s".
     *
     * @return string
     */
    public function __toString(): string
    {
        return \sprintf('%s %s', $this->getDate(), $this->getTime());
    }

    /**
     * Returns a new DateTime object from native values.
     *
     * @param int    $year
     * @param string $month
     * @param int    $day
     * @param int    $hour
     * @param int    $minute
     * @param int    $second
     *
     * @throws Exception\InvalidDateException
     *
     * @return DateTime|ValueObjectInterface
     */
    public static function fromNative(): ValueObjectInterface
    {
        $args = func_get_args();

        $date = Date::fromNative($args[0], $args[1], $args[2]);
        $time = Time::fromNative($args[3], $args[4], $args[5]);

        return new static($date, $time);
    }

    /**
     * Returns a new DateTime from a native PHP \DateTime.
     *
     * @param \DateTime $date_time
     *
     * @throws Exception\InvalidDateException
     *
     * @return DateTime
     */
    public static function fromNativeDateTime(\DateTime $date_time): DateTime
    {
        $date = Date::fromNativeDateTime($date_time);
        $time = Time::fromNativeDateTime($date_time);

        return new static($date, $time);
    }

    /**
     * Returns current DateTime.
     *
     * @throws Exception\InvalidDateException
     *
     * @return DateTime
     */
    public static function now(): DateTime
    {
        $dateTime = new static(Date::now(), Time::now());

        return $dateTime;
    }

    /**
     * Tells whether two DateTime are equal by comparing their values.
     *
     * @param ValueObjectInterface $date_time
     *
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $date_time): bool
    {
        if (false === Util::classEquals($this, $date_time)) {
            return false;
        }

        return $this->getDate()->sameValueAs($date_time->getDate())
            && $this->getTime()->sameValueAs($date_time->getTime());
    }

    /**
     * Returns date from current DateTime.
     *
     * @return Date
     */
    public function getDate(): Date
    {
        return clone $this->date;
    }

    /**
     * Returns time from current DateTime.
     *
     * @return Time
     */
    public function getTime(): Time
    {
        return clone $this->time;
    }

    /**
     * Returns a native PHP \DateTime version of the current DateTime.
     *
     * @return \DateTime
     */
    public function toNativeDateTime(): \DateTime
    {
        $year = $this->getDate()->getYear()->toNative();
        $month = $this->getDate()->getMonth()->getNumericValue();
        $day = $this->getDate()->getDay()->toNative();
        $hour = $this->getTime()->getHour()->toNative();
        $minute = $this->getTime()->getMinute()->toNative();
        $second = $this->getTime()->getSecond()->toNative();

        $dateTime = new \DateTime();
        $dateTime->setDate($year, $month, $day);
        $dateTime->setTime($hour, $minute, $second);

        return $dateTime;
    }
}
