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

use ValueObjects\Enum\Enum;

/**
 * Class WeekDay.
 */
class WeekDay extends Enum
{
    const MONDAY = 'Monday';
    const TUESDAY = 'Tuesday';
    const WEDNESDAY = 'Wednesday';
    const THURSDAY = 'Thursday';
    const FRIDAY = 'Friday';
    const SATURDAY = 'Saturday';
    const SUNDAY = 'Sunday';

    /**
     * Returns the current week day.
     *
     * @return WeekDay
     */
    public static function now(): WeekDay
    {
        return static::fromNativeDateTime(new \DateTime('now'));
    }

    /**
     * Returns a WeekDay from a PHP native \DateTime.
     *
     * @param \DateTime $date
     *
     * @return WeekDay
     */
    public static function fromNativeDateTime(\DateTime $date): WeekDay
    {
        $weekDay = \strtoupper($date->format('l'));

        return static::byName($weekDay);
    }

    /**
     * Returns a numeric representation of the WeekDay.
     * 1 for Monday to 7 for Sunday.
     *
     * @return int
     */
    public function getNumericValue(): int
    {
        return $this->getOrdinal() + 1;
    }
}
