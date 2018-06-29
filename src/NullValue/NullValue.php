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

namespace ValueObjects\NullValue;

use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

/**
 * Class NullValue.
 */
class NullValue implements ValueObjectInterface
{
    /**
     * Returns a string representation of the NullValue object.
     *
     * @return string
     */
    public function __toString(): string
    {
        return \strval(null);
    }

    /**
     * @throws \BadMethodCallException
     */
    public static function fromNative(): ValueObjectInterface
    {
        throw new \BadMethodCallException('Cannot create a NullValue object via this method.');
    }

    /**
     * Returns a new NullValue object.
     *
     * @return NullValue|ValueObjectInterface
     */
    public static function create(): ValueObjectInterface
    {
        return new static();
    }

    /**
     * Tells whether two objects are both NullValue.
     *
     * @param NullValue|ValueObjectInterface $null
     *
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $null): bool
    {
        return Util::classEquals($this, $null);
    }
}
