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

use ValueObjects\DateTime\Exception\InvalidTimeZoneException;
use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

/**
 * Class TimeZone.
 */
class TimeZone implements ValueObjectInterface
{
    /** @var StringLiteral */
    protected $name;

    /**
     * Returns a new TimeZone object.
     *
     * @param StringLiteral $name
     *
     * @throws InvalidTimeZoneException
     */
    public function __construct(StringLiteral $name)
    {
        if (!in_array($name->toNative(), timezone_identifiers_list())) {
            throw new InvalidTimeZoneException($name);
        }

        $this->name = $name;
    }

    /**
     * Returns timezone name as string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return \strval($this->getName());
    }

    /**
     * Returns a new Time object from native timezone name.
     *
     * @param string $name
     *
     * @throws InvalidTimeZoneException
     *
     * @return TimeZone|ValueObjectInterface
     */
    public static function fromNative(): ValueObjectInterface
    {
        $args = func_get_args();

        $name = new StringLiteral($args[0]);

        return new static($name);
    }

    /**
     * Returns a new Time from a native PHP \DateTime.
     *
     * @param \DateTimeZone $timezone
     *
     * @throws InvalidTimeZoneException
     *
     * @return TimeZone|ValueObjectInterface
     */
    public static function fromNativeDateTimeZone(\DateTimeZone $timezone): ValueObjectInterface
    {
        return static::fromNative($timezone->getName());
    }

    /**
     * Returns default TimeZone.
     *
     * @throws InvalidTimeZoneException
     *
     * @return TimeZone|ValueObjectInterface
     */
    public static function fromDefault()
    {
        return new static(new StringLiteral(date_default_timezone_get()));
    }

    /**
     * Returns a native PHP \DateTimeZone version of the current TimeZone.
     *
     * @return \DateTimeZone
     */
    public function toNativeDateTimeZone(): \DateTimeZone
    {
        return new \DateTimeZone($this->getName()->toNative());
    }

    /**
     * Tells whether two DateTimeZone are equal by comparing their names.
     *
     * @param ValueObjectInterface|TimeZone $timezone
     *
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $timezone): bool
    {
        if (false === Util::classEquals($this, $timezone)) {
            return false;
        }

        return $this->getName()->sameValueAs($timezone->getName());
    }

    /**
     * Returns timezone name.
     *
     * @return StringLiteral
     */
    public function getName(): StringLiteral
    {
        return clone $this->name;
    }
}
