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

use DateTime;
use ValueObjects\Enum\Enum;

use function strtoupper;

/**
 * Month.
 *
 * @method static self JANUARY()
 * @method static self FEBRUARY()
 * @method static self MARCH()
 * @method static self APRIL()
 * @method static self MAY()
 * @method static self JUNE()
 * @method static self JULY()
 * @method static self AUGUST()
 * @method static self SEPTEMBER()
 * @method static self OCTOBER()
 * @method static self NOVEMBER()
 * @method static self DECEMBER()
 */
class Month extends Enum
{
    public const JANUARY = 'January';
    public const FEBRUARY = 'February';
    public const MARCH = 'March';
    public const APRIL = 'April';
    public const MAY = 'May';
    public const JUNE = 'June';
    public const JULY = 'July';
    public const AUGUST = 'August';
    public const SEPTEMBER = 'September';
    public const OCTOBER = 'October';
    public const NOVEMBER = 'November';
    public const DECEMBER = 'December';

    /**
     * Get current Month.
     *
     * @return Month
     */
    public static function now(): Month
    {
        $now = new DateTime('now');

        return static::fromNativeDateTime($now);
    }

    /**
     * Returns Month from a native PHP \DateTime.
     *
     * @param DateTime $date
     *
     * @return Month
     */
    public static function fromNativeDateTime(
        DateTime $date
    ): Month {
        return static::byName(strtoupper($date->format('F')));
    }

    /**
     * Returns a numeric representation of the Month.
     * 1 for January to 12 for December.
     *
     * @return int
     */
    public function getNumericValue(): int
    {
        return $this->getOrdinal() + 1;
    }
}
