<?php

namespace ValueObjects\Web;

use ValueObjects\Exception\InvalidNativeArgumentException;

class IPv6Address extends IPAddress
{
    /**
     * Returns a new IPv6Address
     *
     * @param string $value
     */
    public function __construct($value)
    {
        $filteredValue = filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);

        if ($filteredValue === false) {
            throw new InvalidNativeArgumentException($value, array('string (valid ipv6 address)'));
        }

        $this->value = $filteredValue;
    }
}
