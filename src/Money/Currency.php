<?php

namespace ValueObjects\Money;

use Money\Currency as BaseCurrency;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

class Currency implements ValueObjectInterface
{
    /** @var BaseCurrency */
    protected $currency;

    /** @var CurrencyCode  */
    protected $code;

    /**
     * Returns a new Currency object from native string currency code
     *
     * @param  string $code Currency code
     * @return static
     */
    public static function fromNative()
    {
        $code = CurrencyCode::get(func_get_arg(0));

        return new static($code);
    }

    public function __construct(CurrencyCode $code)
    {
        $this->code     = $code;
        $this->currency = new BaseCurrency($code->toNative());
    }

    /**
     * Tells whether two Currency are equal by comparing their names
     *
     * @param  ValueObjectInterface $currency
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $currency)
    {
        if (false === Util::classEquals($this, $currency)) {
            return false;
        }

        return $this->getCode()->toNative() == $currency->getCode()->toNative();
    }

    /**
     * Returns currency code
     *
     * @return CurrencyCode
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Returns string representation of the currency
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getCode()->toNative();
    }
}
