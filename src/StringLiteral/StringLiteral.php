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

namespace ValueObjects\StringLiteral;

use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

/**
 * Class StringLiteral.
 */
class StringLiteral implements ValueObjectInterface
{
    protected $value;

    /**
     * Returns a StringLiteral object given a PHP native string as parameter.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * Returns the string value itself.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->toNative();
    }

    /**
     * Returns a StringLiteral object given a PHP native string as parameter.
     *
     * @param string $value
     *
     * @return StringLiteral|ValueObjectInterface
     */
    public static function fromNative(): ValueObjectInterface
    {
        $value = func_get_arg(0);

        return new static($value);
    }

    /**
     * Returns the value of the string.
     *
     * @return string
     */
    public function toNative(): string
    {
        return $this->value;
    }

    /**
     * Tells whether two string literals are equal by comparing their values.
     *
     * @param ValueObjectInterface $stringLiteral
     *
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $stringLiteral): bool
    {
        if (false === Util::classEquals($this, $stringLiteral)) {
            return false;
        }

        return $this->toNative() === $stringLiteral->toNative();
    }

    /**
     * Tells whether the StringLiteral is empty.
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return 0 == \strlen($this->toNative());
    }
}
