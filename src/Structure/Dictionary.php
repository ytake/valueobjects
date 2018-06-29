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

use SplFixedArray;
use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\ValueObjectInterface;

/**
 * Class Dictionary.
 */
class Dictionary extends Collection
{
    /**
     * Returns a new Dictionary object.
     *
     * @param SplFixedArray $key_value_pairs
     */
    public function __construct(SplFixedArray $pairs)
    {
        foreach ($pairs as $keyValuePair) {
            if (false === $keyValuePair instanceof KeyValuePair) {
                $type = \is_object($keyValuePair) ? \get_class($keyValuePair) : \gettype($keyValuePair);

                throw new \InvalidArgumentException(
                    \sprintf(
                        'Passed SplFixedArray object must contains "KeyValuePair" objects only. "%s" given.',
                        $type
                    )
                );
            }
        }

        $this->items = $pairs;
    }

    /**
     * Returns a new Dictionary object.
     *
     * @param ...array $array
     *
     * @return Dictionary|ValueObjectInterface
     */
    public static function fromNative(): ValueObjectInterface
    {
        $array = \func_get_arg(0);
        $keyValuePairs = [];

        foreach ($array as $arrayKey => $arrayValue) {
            $key = new StringLiteral(\strval($arrayKey));

            if ($arrayValue instanceof \Traversable || \is_array($arrayValue)) {
                $value = Collection::fromNative($arrayValue);
            } else {
                $value = new StringLiteral(\strval($arrayValue));
            }
            $keyValuePairs[] = new KeyValuePair($key, $value);
        }

        return new static(SplFixedArray::fromArray($keyValuePairs));
    }

    /**
     * Returns a Collection of the keys.
     *
     * @return Collection
     */
    public function keys(): Collection
    {
        $count = $this->count()->toNative();
        $keysArray = new SplFixedArray($count);

        foreach ($this->items as $key => $item) {
            $keysArray->offsetSet($key, $item->getKey());
        }

        return new Collection($keysArray);
    }

    /**
     * Returns a Collection of the values.
     *
     * @return Collection
     */
    public function values(): Collection
    {
        $count = $this->count()->toNative();
        $valuesArray = new SplFixedArray($count);

        foreach ($this->items as $key => $item) {
            $valuesArray->offsetSet($key, $item->getValue());
        }

        return new Collection($valuesArray);
    }

    /**
     * Tells whether $object is one of the keys.
     *
     * @param ValueObjectInterface $object
     *
     * @return bool
     */
    public function containsKey(ValueObjectInterface $object): bool
    {
        $keys = $this->keys();

        return $keys->contains($object);
    }

    /**
     * Tells whether $object is one of the values.
     *
     * @param ValueObjectInterface $object
     *
     * @return bool
     */
    public function containsValue(ValueObjectInterface $object): bool
    {
        $values = $this->values();

        return $values->contains($object);
    }
}
