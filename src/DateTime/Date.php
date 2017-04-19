<?php

namespace ValueObjects\DateTime;

use ValueObjects\DateTime\Exception\InvalidDateException;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

class Date implements ValueObjectInterface
{
    /** @var Year */
    protected $year;

    /** @var Month */
    protected $month;

    /** @var MonthDay */
    protected $day;

    /**
     * Returns a new Date from native year, month and day values
     *
     * @param  int    $year
     * @param  string $month
     * @param  int    $day
     * @return Date
     */
    public static function fromNative()
    {
        $args = func_get_args();

        $year  = new Year($args[0]);
        $month = Month::fromNative($args[1]);
        $day   = new MonthDay($args[2]);

        return new static($year, $month, $day);
    }

    /**
     * Returns a new Date from a native PHP \DateTime
     *
     * @param  \DateTime $date
     * @return Date
     */
    public static function fromNativeDateTime(\DateTime $date)
    {
        $year  = \intval($date->format('Y'));
        $month = Month::fromNativeDateTime($date);
        $day   = \intval($date->format('d'));

        return new static(new Year($year), $month, new MonthDay($day));
    }

    /**
     * Returns current Date
     *
     * @return Date
     */
    public static function now()
    {
        $date = new static(Year::now(), Month::now(), MonthDay::now());

        return $date;
    }

    /**
     * Create a new Date
     *
     * @param  Year                 $year
     * @param  Month                $month
     * @param  MonthDay             $day
     * @throws InvalidDateException
     */
    public function __construct(Year $year, Month $month, MonthDay $day)
    {
        \DateTime::createFromFormat('Y-F-j', \sprintf('%d-%s-%d', $year->toNative(), $month, $day->toNative()));
        $nativeDateErrors = \DateTime::getLastErrors();

        if ($nativeDateErrors['warning_count'] > 0 || $nativeDateErrors['error_count'] > 0) {
            throw new InvalidDateException($year->toNative(), $month->toNative(), $day->toNative());
        }

        $this->year  = $year;
        $this->month = $month;
        $this->day   = $day;
    }

    /**
     * Tells whether two Date are equal by comparing their values
     *
     * @param  ValueObjectInterface $date
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $date)
    {
        if (false === Util::classEquals($this, $date)) {
            return false;
        }

        return $this->getYear()->sameValueAs($date->getYear()) &&
               $this->getMonth()->sameValueAs($date->getMonth()) &&
               $this->getDay()->sameValueAs($date->getDay());
    }

    /**
     * Get year
     *
     * @return Year
     */
    public function getYear()
    {
        return clone $this->year;
    }

    /**
     * Get month
     *
     * @return Month
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * Get day
     *
     * @return MonthDay
     */
    public function getDay()
    {
        return clone $this->day;
    }

    /**
     * Returns a native PHP \DateTime version of the current Date
     *
     * @return \DateTime
     */
    public function toNativeDateTime()
    {
        $year  = $this->getYear()->toNative();
        $month = $this->getMonth()->getNumericValue();
        $day   = $this->getDay()->toNative();

        $date = new \DateTime();
        $date->setDate($year, $month, $day);
        $date->setTime(0, 0, 0);

        return $date;
    }

    /**
     * Returns date as string in format Y-n-j
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toNativeDateTime()->format('Y-n-j');
    }
}
