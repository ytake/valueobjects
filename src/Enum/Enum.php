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

namespace ValueObjects\Enum;

use MabeEnum\Enum as BaseEnum;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

/**
 * Class Enum.
 */
abstract class Enum extends BaseEnum implements ValueObjectInterface
{
    /**
     * Returns a native string representation of the Enum value.
     *
     * @return string
     */
    public function __toString(): string
    {
        return \strval($this->toNative());
    }

    /**
     * Returns a new Enum object from passed value matching argument.
     *
     * @param string... $value
     *
     * @return static
     */
    public static function fromNative(): ValueObjectInterface
    {
        return static::get(func_get_arg(0));
    }

    /**
     * Returns the PHP native value of the enum.
     *
     * @return mixed
     */
    public function toNative()
    {
        return parent::getValue();
    }

    /**
     * Tells whether two Enum objects are sameValueAs by comparing their values.
     *
     * @param ValueObjectInterface $enum
     *
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $enum): bool
    {
        if (false === Util::classEquals($this, $enum)) {
            return false;
        }

        return $this->toNative() === $enum->toNative();
    }
}
