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

namespace ValueObjects\Structure;

use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

/**
 * Class KeyValuePair.
 */
class KeyValuePair implements ValueObjectInterface
{
    /** @var ValueObjectInterface */
    protected $key;

    /** @var ValueObjectInterface */
    protected $value;

    /**
     * Returns a KeyValuePair.
     *
     * @param ValueObjectInterface $key
     * @param ValueObjectInterface $value
     */
    public function __construct(
        ValueObjectInterface $key,
        ValueObjectInterface $value
    ) {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * Returns a string representation of the KeyValuePair in format "$key => $value".
     *
     * @return string
     */
    public function __toString(): string
    {
        return sprintf('%s => %s', $this->getKey(), $this->getValue());
    }

    /**
     * Returns a KeyValuePair from native PHP arguments evaluated as strings.
     *
     * @param string $key
     * @param string $value
     *
     * @throws \InvalidArgumentException
     *
     * @return KeyValuePair|ValueObjectInterface
     * @return KeyValuePair|ValueObjectInterface
     */
    public static function fromNative(): ValueObjectInterface
    {
        $args = func_get_args();

        if (2 != count($args)) {
            throw new \BadMethodCallException('This methods expects two arguments. One for the key and one for the value.');
        }

        $keyString = \strval($args[0]);
        $valueString = \strval($args[1]);
        $key = new StringLiteral($keyString);
        $value = new StringLiteral($valueString);

        return new static($key, $value);
    }

    /**
     * Tells whether two KeyValuePair are equal.
     *
     * @param KeyValuePair|ValueObjectInterface $keyValuePair
     *
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $keyValuePair): bool
    {
        if (false === Util::classEquals($this, $keyValuePair)) {
            return false;
        }

        return $this->getKey()->sameValueAs($keyValuePair->getKey())
            && $this->getValue()->sameValueAs($keyValuePair->getValue());
    }

    /**
     * Returns key.
     *
     * @return ValueObjectInterface
     */
    public function getKey(): ValueObjectInterface
    {
        return clone $this->key;
    }

    /**
     * Returns value.
     *
     * @return ValueObjectInterface
     */
    public function getValue(): ValueObjectInterface
    {
        return clone $this->value;
    }
}
