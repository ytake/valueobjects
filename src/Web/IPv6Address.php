<?php
declare(strict_types=1);

namespace ValueObjects\Web;

use ValueObjects\Exception\InvalidNativeArgumentException;

/**
 * Class IPv6Address
 */
class IPv6Address extends IPAddress
{
    /**
     * Returns a new IPv6Address
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $filteredValue = filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);
        if ($filteredValue === false) {
            throw new InvalidNativeArgumentException($value, ['string (valid ipv6 address)']);
        }
        $this->value = $filteredValue;
    }
}
