<?php
declare(strict_types=1);

namespace ValueObjects\Money;

use Money\Currency as BaseCurrency;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

/**
 * Class Currency
 */
class Currency implements ValueObjectInterface
{
    /** @var BaseCurrency */
    protected $currency;

    /** @var CurrencyCode */
    protected $code;

    /**
     * Returns a new Currency object from native string currency code
     *
     * @param  ...string $code Currency code
     *
     * @return Currency|ValueObjectInterface
     */
    public static function fromNative(): ValueObjectInterface
    {
        return new static(CurrencyCode::get(func_get_arg(0)));
    }

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
     * Tells whether two Currency are equal by comparing their names
     *
     * @param  Currency|ValueObjectInterface $currency
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
     * Returns currency code
     *
     * @return CurrencyCode
     */
    public function getCode(): CurrencyCode
    {
        return $this->code;
    }

    /**
     * Returns string representation of the currency
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->getCode()->toNative();
    }
}
