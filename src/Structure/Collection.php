<?php

namespace ValueObjects\Structure;

use ValueObjects\Util\Util;
use ValueObjects\Number\Natural;
use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\ValueObjectInterface;

class Collection implements ValueObjectInterface
{
    /** @var \SplFixedArray */
    protected $items;

    /**
     * Returns a new Collection object
     *
     * @param  \SplFixedArray $array
     * @return self
     */
    public static function fromNative()
    {
        $array = \func_get_arg(0);
        $items = array();

        foreach ($array as $item) {
            if ($item instanceof \Traversable || \is_array($item)) {
                $items[] = static::fromNative($item);
            } else {
                $items[] = new StringLiteral(\strval($item));
            }
        }

        $fixedArray = \SplFixedArray::fromArray($items);

        return new static($fixedArray);
    }

    /**
     * Returns a new Collection object
     *
     * @return self
     */
    public function __construct(\SplFixedArray $items)
    {
        foreach ($items as $item) {
            if (false === $item instanceof ValueObjectInterface) {
                $type = \is_object($item) ? \get_class($item) : \gettype($item);
                throw new \InvalidArgumentException(\sprintf('Passed SplFixedArray object must contains "ValueObjectInterface" objects only. "%s" given.', $type));
            }
        }

        $this->items = $items;
    }

    /**
     * Tells whether two Collection are equal by comparing their size and items (item order matters)
     *
     * @param  ValueObjectInterface $collection
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $collection)
    {
        if (false === Util::classEquals($this, $collection) || false === $this->count()->sameValueAs($collection->count())) {
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
     * Returns the number of objects in the collection
     *
     * @return Natural
     */
    public function count()
    {
        return new Natural($this->items->count());
    }

    /**
     * Tells whether the Collection contains an object
     *
     * @param  ValueObjectInterface $object
     * @return bool
     */
    public function contains(ValueObjectInterface $object)
    {
        foreach ($this->items as $item) {
            if ($item->sameValueAs($object)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Returns a native array representation of the Collection
     *
     * @return array
     */
    public function toArray()
    {
        return $this->items->toArray();
    }

    /**
     * Returns a native string representation of the Collection object
     *
     * @return string
     */
    public function __toString()
    {
        $string = \sprintf('%s(%d)', \get_class($this), $this->count()->toNative());

        return $string;
    }
}
