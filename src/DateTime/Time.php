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

/**
 * Class Time.
 */
class Time implements ValueObjectInterface
{
    /** @var Hour */
    protected $hour;

    /** @var Minute */
    protected $minute;

    /** @var Second */
    protected $second;

    /**
     * Returns a new Time objects.
     *
     * @param Hour   $hour
     * @param Minute $minute
     * @param Second $second
     */
    public function __construct(Hour $hour, Minute $minute, Second $second)
    {
        $this->hour = $hour;
        $this->minute = $minute;
        $this->second = $second;
    }

    /**
     * Returns time as string in format G:i:s.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->toNativeDateTime()->format('G:i:s');
    }

    /**
     * Returns a nee Time object from native int hour, minute and second.
     *
     * @param int $hour
     * @param int $minute
     * @param int $second
     *
     * @return Time|ValueObjectInterface
     */
    public static function fromNative(): ValueObjectInterface
    {
        $args = func_get_args();

        return new static(new Hour($args[0]), new Minute($args[1]), new Second($args[2]));
    }

    /**
     * Returns a new Time from a native PHP \DateTime.
     *
     * @param \DateTime $time
     *
     * @return Time|ValueObjectInterface
     */
    public static function fromNativeDateTime(\DateTime $time): ValueObjectInterface
    {
        $hour = \intval($time->format('G'));
        $minute = \intval($time->format('i'));
        $second = \intval($time->format('s'));

        return static::fromNative($hour, $minute, $second);
    }

    /**
     * Returns current Time.
     *
     * @return Time|ValueObjectInterface
     */
    public static function now(): ValueObjectInterface
    {
        return new static(Hour::now(), Minute::now(), Second::now());
    }

    /**
     * Return zero time.
     *
     * @return Time|ValueObjectInterface
     */
    public static function zero(): ValueObjectInterface
    {
        return new static(new Hour(0), new Minute(0), new Second(0));
    }

    /**
     * Tells whether two Time are equal by comparing their values.
     *
     * @param Time|ValueObjectInterface $time
     *
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $time): bool
    {
        if (false === Util::classEquals($this, $time)) {
            return false;
        }

        return $this->getHour()->sameValueAs($time->getHour())
            && $this->getMinute()->sameValueAs($time->getMinute())
            && $this->getSecond()->sameValueAs($time->getSecond());
    }

    /**
     * Get hour.
     *
     * @return Hour
     */
    public function getHour(): Hour
    {
        return $this->hour;
    }

    /**
     * Get minute.
     *
     * @return Minute
     */
    public function getMinute(): Minute
    {
        return $this->minute;
    }

    /**
     * Get second.
     *
     * @return Second
     */
    public function getSecond(): Second
    {
        return $this->second;
    }

    /**
     * Returns a native PHP \DateTime version of the current Time.
     * Date is set to current.
     *
     * @return \DateTime
     */
    public function toNativeDateTime(): \DateTime
    {
        $hour = $this->getHour()->toNative();
        $minute = $this->getMinute()->toNative();
        $second = $this->getSecond()->toNative();

        $time = new \DateTime('now');
        $time->setTime($hour, $minute, $second);

        return $time;
    }
}
