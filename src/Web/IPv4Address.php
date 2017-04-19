<?php

namespace ValueObjects\Web;

use ValueObjects\Exception\InvalidNativeArgumentException;

class IPv4Address extends IPAddress
{
    /**
     * Returns a new IPv4Address
     *
     * @param string $value
     */
    public function __construct($value)
    {
        $filteredValue = filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);

        if ($filteredValue === false) {
            throw new InvalidNativeArgumentException($value, array('string (valid ipv4 address)'));
        }

        $this->value = $filteredValue;
    }
}
