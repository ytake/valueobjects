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
use ValueObjects\Number\Natural;
use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

/**
 * Class Collection.
 */
class Collection implements ValueObjectInterface
{
    /** @var SplFixedArray */
    protected $items;

    /**
     * Returns a new Collection object.
     *
     * @param SplFixedArray $items
     */
    public function __construct(SplFixedArray $items)
    {
        foreach ($items as $item) {
            if (false === $item instanceof ValueObjectInterface) {
                $type = \is_object($item) ? \get_class($item) : \gettype($item);

                throw new \InvalidArgumentException(
                    \sprintf(
                        'Passed SplFixedArray object must contains "ValueObjectInterface" objects only. "%s" given.',
                        $type
                    )
                );
            }
        }

        $this->items = $items;
    }

    /**
     * Returns a native string representation of the Collection object.
     *
     * @return string
     */
    public function __toString(): string
    {
        $string = \sprintf('%s(%d)', \get_class($this), $this->count()->toNative());

        return $string;
    }

    /**
     * Returns a new Collection object.
     *
     * @param ...SplFixedArray $array
     *
     * @return Collection|ValueObjectInterface
     */
    public static function fromNative(): ValueObjectInterface
    {
        $array = \func_get_arg(0);
        $items = [];

        foreach ($array as $item) {
            if ($item instanceof \Traversable || \is_array($item)) {
                $items[] = static::fromNative($item);
            } else {
                $items[] = new StringLiteral(\strval($item));
            }
        }

        return new static(SplFixedArray::fromArray($items));
    }

    /**
     * Tells whether two Collection are equal by comparing their size and items (item order matters).
     *
     * @param Collection|ValueObjectInterface $collection
     *
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $collection): bool
    {
        if (false === Util::classEquals($this, $collection)
            || false === $this->count()->sameValueAs($collection->count())) {
            return false;
        }

        $arrayCollection = $collection->toArray();

        foreach ($this->items as $index => $item) {
            if (!isset($arrayCollection[$index]) || false === $item->sameValueAs($arrayCollection[$index])) {
                return false;
            }
        }

        return true;
    }

    /**
     * Returns the number of objects in the collection.
     *
     * @return Natural
     */
    public function count(): Natural
    {
        return new Natural($this->items->count());
    }

    /**
     * Tells whether the Collection contains an object.
     *
     * @param ValueObjectInterface $object
     *
     * @return bool
     */
    public function contains(ValueObjectInterface $object): bool
    {
        foreach ($this->items as $item) {
            if ($item->sameValueAs($object)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Returns a native array representation of the Collection.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->items->toArray();
    }
}
