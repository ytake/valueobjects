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

namespace ValueObjects\Number;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

/**
 * Class Integer.
 */
class Integer extends Real
{
    /**
     * Returns a Integer object given a PHP native int as parameter.
     *
     * @param string|\int $value
     */
    public function __construct($value)
    {
        $value = filter_var($value, FILTER_VALIDATE_INT);

        if (false === $value) {
            throw new InvalidNativeArgumentException($value, ['int']);
        }
        parent::__construct($value);
    }

    /**
     * Tells whether two Integer are equal by comparing their values.
     *
     * @param int|ValueObjectInterface $integer
     *
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $integer): bool
    {
        if (false === Util::classEquals($this, $integer)) {
            return false;
        }

        return $this->toNative() === $integer->toNative();
    }

    /**
     * Returns the value of the integer number.
     *
     * @return int
     */
    public function toNative(): int
    {
        return \intval(parent::toNative());
    }

    /**
     * Returns a Real with the value of the Integer.
     *
     * @return float
     */
    public function toReal(): Real
    {
        $real = new Real($this->toNative());

        return $real;
    }
}
