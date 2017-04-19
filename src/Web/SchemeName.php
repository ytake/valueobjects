<?php

namespace ValueObjects\Web;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\StringLiteral\StringLiteral;

class SchemeName extends StringLiteral
{
    /**
     * Returns a SchemeName
     *
     * @param string $value
     */
    public function __construct($value)
    {
        if (0 === \preg_match('/^[a-z]([a-z0-9\+\.-]+)?$/i', $value)) {
            throw new InvalidNativeArgumentException($value, array('string (valid scheme name)'));
        }

        $this->value = $value;
    }
}
