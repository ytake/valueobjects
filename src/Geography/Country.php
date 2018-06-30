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

namespace ValueObjects\Geography;

use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

/**
 * Class Country.
 */
class Country implements ValueObjectInterface
{
    /** @var CountryCode */
    protected $code;

    /**
     * Returns a new Country object.
     *
     * @param CountryCode $code
     */
    public function __construct(CountryCode $code)
    {
        $this->code = $code;
    }

    /**
     * Returns country name as native string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->getName()->toNative();
    }

    /**
     * Returns a new Country object given a native PHP string country code.
     *
     * @param ...string $code
     *
     * @return Country|ValueObjectInterface
     */
    public static function fromNative(): ValueObjectInterface
    {
        $codeString = \func_get_arg(0);
        $code = CountryCode::byName($codeString);
        $country = new static($code);

        return $country;
    }

    /**
     * Tells whether two Country are equal.
     *
     * @param Country|ValueObjectInterface $country
     *
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $country): bool
    {
        if (false === Util::classEquals($this, $country)) {
            return false;
        }

        return $this->getCode()->sameValueAs($country->getCode());
    }

    /**
     * Returns country code.
     *
     * @return CountryCode
     */
    public function getCode(): CountryCode
    {
        return $this->code;
    }

    /**
     * Returns country name.
     *
     * @return StringLiteral
     */
    public function getName(): StringLiteral
    {
        return CountryCodeName::getName($this->getCode());
    }
}
