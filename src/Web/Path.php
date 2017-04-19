<?php

namespace ValueObjects\Web;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\StringLiteral\StringLiteral;

class Path extends StringLiteral
{
    public function __construct($value)
    {
        $filteredValue = parse_url($value, PHP_URL_PATH);

        if (null === $filteredValue || strlen($filteredValue) != strlen($value)) {
            throw new InvalidNativeArgumentException($value, array('string (valid url path)'));
        }

        $this->value = $filteredValue;
    }
}
