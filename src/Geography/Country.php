<?php

namespace ValueObjects\Geography;

use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

class Country implements ValueObjectInterface
{
    /** @var CountryCode */
    protected $code;

    /**
     * Returns a new Country object given a native PHP string country code
     *
     * @param  string $code
     * @return self
     */
    public static function fromNative()
    {
        $codeString = \func_get_arg(0);
        $code       = CountryCode::getByName($codeString);
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
     * @param  ValueObjectInterface $country
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $country)
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
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Returns country name
     *
     * @return StringLiteral
     */
    public function getName()
    {
        $code = $this->getCode();
        $name = CountryCodeName::getName($code);

        return $name;
    }

    /**
     * Returns country name as native string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName()->toNative();
    }
}
