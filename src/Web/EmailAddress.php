<?php

namespace ValueObjects\Web;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\StringLiteral\StringLiteral;

class EmailAddress extends StringLiteral
{
    /**
     * Returns an EmailAddress object given a PHP native string as parameter.
     *
     * @param string $value
     */
    public function __construct($value)
    {
        $filteredValue = filter_var($value, FILTER_VALIDATE_EMAIL);

        if ($filteredValue === false) {
            throw new InvalidNativeArgumentException($value, array('string (valid email address)'));
        }

        $this->value = $filteredValue;
    }

    /**
     * Returns the local part of the email address
     *
     * @return StringLiteral
     */
    public function getLocalPart()
    {
        $parts = explode('@', $this->toNative());
        $localPart = new StringLiteral($parts[0]);

        return $localPart;
    }

    /**
     * Returns the domain part of the email address
     *
     * @return Domain
     */
    public function getDomainPart()
    {
        $parts = \explode('@', $this->toNative());
        $domain = \trim($parts[1], '[]');

        return Domain::specifyType($domain);
    }
}
