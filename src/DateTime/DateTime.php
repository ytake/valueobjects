<?php

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
     * Returns a new DateTime object from native values
     *
     * @param  int      $year
     * @param  string   $month
     * @param  int      $day
     * @param  int      $hour
     * @param  int      $minute
     * @param  int      $second
     * @return DateTime
     */
    public static function fromNative()
    {
        $args = func_get_args();

        $date = Date::fromNative($args[0], $args[1], $args[2]);
        $time = Time::fromNative($args[3], $args[4], $args[5]);

        return new static($date, $time);
    }

    /**
     * Returns a new DateTime from a native PHP \DateTime
     *
     * @param  \DateTime $date_time
     * @return DateTime
     */
    public static function fromNativeDateTime(\DateTime $date_time)
    {
        $date = Date::fromNativeDateTime($date_time);
        $time = Time::fromNativeDateTime($date_time);

        return new static($date, $time);
    }

    /**
     * Returns current DateTime
     *
     * @return DateTime
     */
    public static function now()
    {
        $dateTime = new static(Date::now(), Time::now());

        return $dateTime;
    }

    /**
     * Returns a new DateTime object
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
     * Tells whether two DateTime are equal by comparing their values
     *
     * @param  ValueObjectInterface $date_time
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $date_time)
    {
        if (false === Util::classEquals($this, $date_time)) {
            return false;
        }

        return $this->getDate()->sameValueAs($date_time->getDate()) && $this->getTime()->sameValueAs($date_time->getTime());
    }

    /**
     * Returns date from current DateTime
     *
     * @return Date
     */
    public function getDate()
    {
        return clone $this->date;
    }

    /**
     * Returns time from current DateTime
     *
     * @return Time
     */
    public function getTime()
    {
        return clone $this->time;
    }

    /**
     * Returns a native PHP \DateTime version of the current DateTime.
     *
     * @return \DateTime
     */
    public function toNativeDateTime()
    {
        $year   = $this->getDate()->getYear()->toNative();
        $month  = $this->getDate()->getMonth()->getNumericValue();
        $day    = $this->getDate()->getDay()->toNative();
        $hour   = $this->getTime()->getHour()->toNative();
        $minute = $this->getTime()->getMinute()->toNative();
        $second = $this->getTime()->getSecond()->toNative();

        $dateTime = new \DateTime();
        $dateTime->setDate($year, $month, $day);
        $dateTime->setTime($hour, $minute, $second);

        return $dateTime;
    }

    /**
     * Returns DateTime as string in format "Y-n-j G:i:s"
     *
     * @return string
     */
    public function __toString()
    {
        return \sprintf('%s %s', $this->getDate(), $this->getTime());
    }
}
