<?php

namespace ValueObjects\Web;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Structure\Dictionary;

class QueryString extends StringLiteral implements QueryStringInterface
{
    /**
     * Returns a new QueryString
     *
     * @param string $value
     */
    public function __construct($value)
    {
        if (0 === \preg_match('/^\?([\w\.\-[\]~&%+]+(=([\w\.\-~&%+]+)?)?)*$/', $value)) {
            throw new InvalidNativeArgumentException($value, array('string (valid query string)'));
        }

        $this->value = $value;
    }

    /**
     * Returns a Dictionary structured representation of the query string
     *
     * @return Dictionary
     */
    public function toDictionary()
    {
        $value = \ltrim($this->toNative(), '?');
        \parse_str($value, $data);

        return Dictionary::fromNative($data);
    }
}
