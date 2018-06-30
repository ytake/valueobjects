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
use Money\Money as BaseMoney;
use ValueObjects\Number\Integer;
use ValueObjects\Number\Real;
use ValueObjects\Number\RoundingMode;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

/**
 * Class Money.
 */
class Money implements ValueObjectInterface
{
    /** @var BaseMoney */
    protected $money;

    /** @var Currency */
    protected $currency;

    /**
     * Returns a Money object.
     *
     * @param int      $amount   Amount expressed in the smallest units of $currency (e.g. cents)
     * @param Currency $currency Currency of the money object
     */
    public function __construct(Integer $amount, Currency $currency)
    {
        $baseCurrency = new BaseCurrency($currency->getCode()->toNative());
        $this->money = new BaseMoney($amount->toNative(), $baseCurrency);
        $this->currency = $currency;
    }

    /**
     * Returns a string representation of the Money value in format "CUR AMOUNT" (e.g.: EUR 1000).
     *
     * @return string
     */
    public function __toString(): string
    {
        return \sprintf('%s %d', $this->getCurrency()->getCode(), $this->getAmount()->toNative());
    }

    /**
     * Returns a Money object from native int amount and string currency code.
     *
     * @param int    $amount   Amount expressed in the smallest units of $currency (e.g. cents)
     * @param string $currency Currency code of the money object
     *
     * @return Money|ValueObjectInterface
     */
    public static function fromNative(): ValueObjectInterface
    {
        $args = func_get_args();

        return new static(
            new Integer($args[0]),
            Currency::fromNative($args[1])
        );
    }

    /**
     *  Tells whether two Currency are equal by comparing their amount and currency.
     *
     * @param Money|ValueObjectInterface $money
     *
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $money): bool
    {
        if (false === Util::classEquals($this, $money)) {
            return false;
        }

        return $this->getAmount()->sameValueAs($money->getAmount())
            && $this->getCurrency()->sameValueAs($money->getCurrency());
    }

    /**
     * Returns money amount.
     *
     * @return \ValueObjects\Number\Integer
     */
    public function getAmount(): Integer
    {
        return new Integer($this->money->getAmount());
    }

    /**
     * Returns money currency.
     *
     * @return Currency
     */
    public function getCurrency(): Currency
    {
        return clone $this->currency;
    }

    /**
     * Add an integer quantity to the amount and returns a new Money object.
     * Use a negative quantity for subtraction.
     *
     * @param \ValueObjects\Number\Integer $quantity Quantity to add
     *
     * @return Money
     */
    public function add(Integer $quantity): Money
    {
        $amount = new Integer($this->getAmount()->toNative() + $quantity->toNative());
        $result = new static($amount, $this->getCurrency());

        return $result;
    }

    /**
     * Multiply the Money amount for a given number and returns a new Money object.
     * Use 0 < Real $multipler < 1 for division.
     *
     * @param float $multiplier
     * @param mixed $rounding_mode Rounding mode of the operation. Defaults to RoundingMode::HALF_UP.
     *
     * @return Money
     */
    public function multiply(Real $multiplier, RoundingMode $rounding_mode = null): Money
    {
        if (null === $rounding_mode) {
            $rounding_mode = RoundingMode::HALF_UP();
        }

        $amount = $this->getAmount()->toNative() * $multiplier->toNative();
        $roundedAmount = new Integer(round($amount, 0, $rounding_mode->toNative()));
        $result = new static($roundedAmount, $this->getCurrency());

        return $result;
    }
}
