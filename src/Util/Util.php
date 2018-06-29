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

namespace ValueObjects\Util;

/**
 * Utility class for methods used all across the library.
 */
class Util
{
    /**
     * Tells whether two objects are of the same class.
     *
     * @param object $objectA
     * @param object $objectB
     *
     * @return bool
     */
    public static function classEquals($objectA, $objectB): bool
    {
        return \get_class($objectA) === \get_class($objectB);
    }

    /**
     * Returns full namespaced class as string.
     *
     * @param mixed $object
     *
     * @return string
     */
    public static function getClassAsString($object): string
    {
        return \get_class($object);
    }
}
