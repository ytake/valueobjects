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

namespace ValueObjects\Web;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\StringLiteral\StringLiteral;

use function parse_url;
use function strlen;
use function strval;

use const PHP_URL_PATH;

/**
 * Class Path.
 */
class Path extends StringLiteral
{
    /**
     * @param string $value
     */
    public function __construct(
        string $value
    ) {
        $filteredValue = strval(parse_url($value, PHP_URL_PATH));

        if (is_null($filteredValue) || strlen($filteredValue) !== strlen($value)) {
            throw new InvalidNativeArgumentException(
                $value,
                ['string (valid url path)']
            );
        }
        $this->value = $filteredValue;
    }
}
