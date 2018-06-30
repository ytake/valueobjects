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

namespace ValueObjects\Money;

use Money\Currency as BaseCurrency;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

/**
 * Class Currency.
 */
class Currency implements ValueObjectInterface
{
    /** @var BaseCurrency */
    protected $currency;

    /** @var CurrencyCode */
    protected $code;

    /**
     * Currency constructor.
     *
     * @param CurrencyCode $code
     */
    public function __construct(CurrencyCode $code)
    {
        $this->code = $code;
        $this->currency = new BaseCurrency($code->toNative());
    }

    /**
     * Returns string representation of the currency.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->getCode()->toNative();
    }

    /**
     * Returns a new Currency object from native string currency code.
     *
     * @param string $code Currency code
     *
     * @return Currency|ValueObjectInterface
     */
    public static function fromNative(): ValueObjectInterface
    {
        return new static(CurrencyCode::get(func_get_arg(0)));
    }

    /**
     * Tells whether two Currency are equal by comparing their names.
     *
     * @param Currency|ValueObjectInterface $currency
     *
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $currency): bool
    {
        if (false === Util::classEquals($this, $currency)) {
            return false;
        }

        return $this->getCode()->toNative() == $currency->getCode()->toNative();
    }

    /**
     * Returns currency code.
     *
     * @return CurrencyCode
     */
    public function getCode(): CurrencyCode
    {
        return $this->code;
    }
}
