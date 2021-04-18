<?php

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

declare(strict_types=1);

namespace ValueObjects\Climate;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Number\Natural;
use ValueObjects\ValueObjectInterface;

use function filter_var;
use function func_get_arg;

/**
 * Class RelativeHumidity.
 */
class RelativeHumidity extends Natural
{
    public const MIN = 0;

    public const MAX = 100;

    /**
     * Returns a new RelativeHumidity object.
     *
     * @param int $value
     */
    public function __construct(int $value)
    {
        $options = [
            'options' => ['min_range' => self::MIN, 'max_range' => self::MAX],
        ];
        $value = filter_var($value, FILTER_VALIDATE_INT, $options);
        if (!$value) {
            throw new InvalidNativeArgumentException(
                $value,
                ['int (>=' . self::MIN . ', <=' . self::MAX . ')'],
            );
        }
        parent::__construct($value);
    }

    /**
     * Returns a new RelativeHumidity from native int value.
     *
     * @param int ...$value
     *
     * @return RelativeHumidity|ValueObjectInterface
     */
    public static function fromNative(...$value): ValueObjectInterface
    {
        return new self(func_get_arg(0));
    }
}
