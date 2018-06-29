<?php
declare(strict_types=1);

namespace ValueObjects\Geography;

use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

/**
 * Class Country
 */
class Country implements ValueObjectInterface
{
    /** @var CountryCode */
    protected $code;

    /**
     * Returns a new Country object given a native PHP string country code
     *
     * @param  ...string $code
     * @return Country|ValueObjectInterface
     */
    public static function fromNative(): ValueObjectInterface
    {
        $codeString = \func_get_arg(0);
        $code       = CountryCode::byName($codeString);
        $country    = new static($code);

        return $country;
    }

    /**
     * Returns a new Country object
     *
     * @param CountryCode $code
     */
    public function __construct(CountryCode $code)
    {
        $this->code = $code;
    }

    /**
     * Tells whether two Country are equal
     *
     * @param  Country|ValueObjectInterface $country
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
     * Returns country code
     *
     * @return CountryCode
     */
    public function getCode(): CountryCode
    {
        return $this->code;
    }

    /**
     * Returns country name
     *
     * @return StringLiteral
     */
    public function getName(): StringLiteral
    {
        return CountryCodeName::getName($this->getCode());
    }

    /**
     * Returns country name as native string
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->getName()->toNative();
    }
}
