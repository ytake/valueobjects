<?php

namespace ValueObjects\Structure;

use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\ValueObjectInterface;

class Dictionary extends Collection
{
    /**
     * Returns a new Dictionary object
     *
     * @param  array $array
     * @return self
     */
    public static function fromNative()
    {
        $array = \func_get_arg(0);
        $keyValuePairs = array();

        foreach ($array as $arrayKey => $arrayValue) {
            $key = new StringLiteral(\strval($arrayKey));

            if ($arrayValue instanceof \Traversable || \is_array($arrayValue)) {
                $value = Collection::fromNative($arrayValue);
            } else {
                $value = new StringLiteral(\strval($arrayValue));
            }

            $keyValuePairs[] = new KeyValuePair($key, $value);
        }

        $fixedArray = \SplFixedArray::fromArray($keyValuePairs);

        return new static($fixedArray);
    }

    /**
     * Returns a new Dictionary object
     *
     * @param \SplFixedArray $key_value_pairs
     */
    public function __construct(\SplFixedArray $key_value_pairs)
    {
        foreach ($key_value_pairs as $keyValuePair) {
            if (false === $keyValuePair instanceof KeyValuePair) {
                $type = \is_object($keyValuePair) ? \get_class($keyValuePair) : \gettype($keyValuePair);
                throw new \InvalidArgumentException(\sprintf('Passed SplFixedArray object must contains "KeyValuePair" objects only. "%s" given.', $type));
            }
        }

        $this->items = $key_value_pairs;
    }

    /**
     * Returns a Collection of the keys
     *
     * @return Collection
     */
    public function keys()
    {
        $count     = $this->count()->toNative();
        $keysArray = new \SplFixedArray($count);

        foreach ($this->items as $key => $item) {
            $keysArray->offsetSet($key, $item->getKey());
        }

        return new Collection($keysArray);
    }

    /**
     * Returns a Collection of the values
     *
     * @return Collection
     */
    public function values()
    {
        $count       = $this->count()->toNative();
        $valuesArray = new \SplFixedArray($count);

        foreach ($this->items as $key => $item) {
            $valuesArray->offsetSet($key, $item->getValue());
        }

        return new Collection($valuesArray);
    }

    /**
     * Tells whether $object is one of the keys
     *
     * @param  ValueObjectInterface $object
     * @return bool
     */
    public function containsKey(ValueObjectInterface $object)
    {
        $keys = $this->keys();

        return $keys->contains($object);
    }

    /**
     * Tells whether $object is one of the values
     *
     * @param  ValueObjectInterface $object
     * @return bool
     */
    public function containsValue(ValueObjectInterface $object)
    {
        $values = $this->values();

        return $values->contains($object);
    }
}
