<?hh // strict

namespace ValueObjects\Util;

class Util
{
    public static function classEquals<T>(T $object_a, T $object_b): bool;

    public static function getClassAsString<T>(T $object): string;
}
