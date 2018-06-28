<?php
declare(strict_types=1);

namespace ValueObjects\Util;

/**
 * Utility class for methods used all across the library
 */
class Util
{
    /**
     * Tells whether two objects are of the same class
     *
     * @param  object $objectA
     * @param  object $objectB
     * @return bool
     */
    public static function classEquals($objectA, $objectB): bool
    {
        return \get_class($objectA) === \get_class($objectB);
    }

    /**
     * Returns full namespaced class as string
     *
     * @param mixed $object
     * @return string
     */
    public static function getClassAsString($object): string
    {
        return \get_class($object);
    }
}
