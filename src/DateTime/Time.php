<?php

namespace ValueObjects\DateTime;

use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

class Time implements ValueObjectInterface
{
    /** @var Hour */
    protected $hour;

    /** @var Minute */
    protected $minute;

    /** @var Second */
    protected $second;

    /**
     * Returns a nee Time object from native int hour, minute and second
     *
     * @param  int  $hour
     * @param  int  $minute
     * @param  int  $second
     * @return self
     */
    public static function fromNative()
    {
        $args = func_get_args();

        $hour   = new Hour($args[0]);
        $minute = new Minute($args[1]);
        $second = new Second($args[2]);

        return new static($hour, $minute, $second);
    }

    /**
     * Returns a new Time from a native PHP \DateTime
     *
     * @param  \DateTime $time
     * @return self
     */
    public static function fromNativeDateTime(\DateTime $time)
    {
        $hour   = \intval($time->format('G'));
        $minute = \intval($time->format('i'));
        $second = \intval($time->format('s'));

        return static::fromNative($hour, $minute, $second);
    }

    /**
     * Returns current Time
     *
     * @return self
     */
    public static function now()
    {
        $time = new static(Hour::now(), Minute::now(), Second::now());

        return $time;
    }

    /**
     * Return zero time
     *
     * @return static
     */
    public static function zero()
    {
        $time = new static(new Hour(0), new Minute(0), new Second(0));

        return $time;
    }

    /**
     * Returns a new Time objects
     *
     * @param Hour   $hour
     * @param Minute $minute
     * @param Second $second
     */
    public function __construct(Hour $hour, Minute $minute, Second $second)
    {
        $this->hour   = $hour;
        $this->minute = $minute;
        $this->second = $second;
    }

    /**
     * Tells whether two Time are equal by comparing their values
     *
     * @param  ValueObjectInterface $time
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $time)
    {
        if (false === Util::classEquals($this, $time)) {
            return false;
        }

        return $this->getHour()->sameValueAs($time->getHour()) && $this->getMinute()->sameValueAs($time->getMinute()) && $this->getSecond()->sameValueAs($time->getSecond());
    }

    /**
     * Get hour
     *
     * @return Hour
     */
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * Get minute
     *
     * @return Minute
     */
    public function getMinute()
    {
        return $this->minute;
    }

    /**
     * Get second
     *
     * @return Second
     */
    public function getSecond()
    {
        return $this->second;
    }

    /**
     * Returns a native PHP \DateTime version of the current Time.
     * Date is set to current.
     *
     * @return \DateTime
     */
    public function toNativeDateTime()
    {
        $hour   = $this->getHour()->toNative();
        $minute = $this->getMinute()->toNative();
        $second = $this->getSecond()->toNative();

        $time = new \DateTime('now');
        $time->setTime($hour, $minute, $second);

        return $time;
    }

    /**
     * Returns time as string in format G:i:s
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toNativeDateTime()->format('G:i:s');
    }
}
