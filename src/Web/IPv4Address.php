<?php
declare(strict_types=1);

namespace ValueObjects\Web;

use ValueObjects\Exception\InvalidNativeArgumentException;

/**
 * Class IPv4Address
 */
class IPv4Address extends IPAddress
{
    /**
     * Returns a new IPv4Address
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $filteredValue = filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);

        if ($filteredValue === false) {
            throw new InvalidNativeArgumentException($value, array('string (valid ipv4 address)'));
        }

        $this->value = $filteredValue;
    }
}
