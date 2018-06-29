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

namespace ValueObjects\Web;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Structure\Dictionary;

/**
 * Class QueryString.
 */
class QueryString extends StringLiteral implements QueryStringInterface
{
    /**
     * Returns a new QueryString.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        if (0 === \preg_match('/^\?([\w\.\-[\]~&%+]+(=([\w\.\-~&%+]+)?)?)*$/', $value)) {
            throw new InvalidNativeArgumentException($value, ['string (valid query string)']);
        }

        $this->value = $value;
    }

    /**
     * Returns a Dictionary structured representation of the query string.
     *
     * @return Dictionary
     */
    public function toDictionary(): Dictionary
    {
        $value = \ltrim($this->toNative(), '?');
        \parse_str($value, $data);

        return Dictionary::fromNative($data);
    }
}
