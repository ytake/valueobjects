<?php

namespace ValueObjects\DateTime;

use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

class DateTimeWithTimeZone implements ValueObjectInterface
{
    /** @var DateTime */
    protected $dateTime;

    /** @var TimeZone */
    protected $timeZone;

    /**
     * Returns a new DateTime object from native values
     *
     * @param int    $year
     * @param string $month
     * @param int    $day
     * @param int    $hour
     * @param int    $minute
     * @param int    $second
     * @param string $timezone
     *
     * @return DateTimeWithTimeZone
     */
    public static function fromNative()
    {
        $args = func_get_args();

        $datetime = DateTime::fromNative($args[0], $args[1], $args[2], $args[3], $args[4], $args[5]);
        $timezone = TimeZone::fromNative($args[6]);

        return new static($datetime, $timezone);
    }

    /**
     * Returns a new DateTime from a native PHP \DateTime
     *
     * @param \DateTime $nativeDatetime
     *
     * @return DateTimeWithTimeZone
     */
    public static function fromNativeDateTime(\DateTime $nativeDatetime)
    {
        $datetime = DateTime::fromNativeDateTime($nativeDatetime);
        $timezone = TimeZone::fromNativeDateTimeZone($nativeDatetime->getTimezone());

        return new static($datetime, $timezone);
    }

    /**
     * Returns a DateTimeWithTimeZone object using current DateTime and default TimeZone
     *
     * @return DateTimeWithTimeZone
     */
    public static function now()
    {
        return new static(DateTime::now(), TimeZone::fromDefault());
    }

    /**
     * Returns a new DateTimeWithTimeZone object
     *
     * @param DateTime $datetime
     * @param TimeZone $timezone
     */
    public function __construct(DateTime $datetime, TimeZone $timezone = null)
    {
        $this->dateTime = $datetime;
        $this->timeZone = $timezone;
    }

    /**
     * Tells whether two DateTimeWithTimeZone are equal by comparing their values
     *
     * @param ValueObjectInterface $dateTimeWithTimeZone
     *
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $dateTimeWithTimeZone)
    {
        if (false === Util::classEquals($this, $dateTimeWithTimeZone)) {
            return false;
        }

        return $this->getDateTime()->sameValueAs($dateTimeWithTimeZone->getDateTime()) &&
            $this->getTimeZone()->sameValueAs($dateTimeWithTimeZone->getTimeZone());
    }

    /**
     * Tells whether two DateTimeWithTimeZone represents the same timestamp
     *
     * @param ValueObjectInterface $dateTimeWithTimeZone
     *
     * @return bool
     */
    public function sameTimestampAs(ValueObjectInterface $dateTimeWithTimeZone)
    {
        if (false === Util::classEquals($this, $dateTimeWithTimeZone)) {
            return false;
        }

        return $this->toNativeDateTime() == $dateTimeWithTimeZone->toNativeDateTime();
    }

    /**
     * Returns datetime from current DateTimeWithTimeZone
     *
     * @return DateTime
     */
    public function getDateTime()
    {
        return clone $this->dateTime;
    }

    /**
     * Returns timezone from current DateTimeWithTimeZone
     *
     * @return TimeZone
     */
    public function getTimeZone()
    {
        return clone $this->timeZone;
    }

    /**
     * Returns a native PHP \DateTime version of the current DateTimeWithTimeZone
     *
     * @return \DateTime
     */
    public function toNativeDateTime()
    {
        $date     = $this->getDateTime()->getDate();
        $time     = $this->getDateTime()->getTime();
        $year     = $date->getYear()->toNative();
        $month    = $date->getMonth()->getNumericValue();
        $day      = $date->getDay()->toNative();
        $hour     = $time->getHour()->toNative();
        $minute   = $time->getMinute()->toNative();
        $second   = $time->getSecond()->toNative();
        $timezone = $this->getTimeZone()->toNativeDateTimeZone();

        $dateTime = new \DateTime();
        $dateTime->setTimezone($timezone);
        $dateTime->setDate($year, $month, $day);
        $dateTime->setTime($hour, $minute, $second);

        return $dateTime;
    }

    /**
     * Returns DateTime as string in format "Y-n-j G:i:s e"
     *
     * @return string
     */
    public function __toString()
    {
        return \sprintf('%s %s', $this->getDateTime(), $this->getTimeZone());
    }
}
