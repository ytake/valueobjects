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

namespace ValueObjects\DateTime;

use DateTime;
use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Number\Natural;

use function intval;
use function filter_var;

use const FILTER_VALIDATE_INT;

/**
 * Second.
 */
class Second extends Natural
{
    public const MIN_SECOND = 0;
    public const MAX_SECOND = 59;

    /**
     * Returns a new Second object.
     *
     * @param int $value
     */
    public function __construct(int $value)
    {
        $options = [
            'options' => ['min_range' => self::MIN_SECOND, 'max_range' => self::MAX_SECOND],
        ];

        $value = filter_var($value, FILTER_VALIDATE_INT, $options);
        if (!$value) {
            throw new InvalidNativeArgumentException($value, ['int (>=0, <=59)']);
        }

        parent::__construct($value);
    }

    /**
     * Returns the current second.
     *
     * @return Second
     */
    public static function now(): Second
    {
        $now = new DateTime('now');
        $second = intval($now->format('s'));

        return new self($second);
    }
}
