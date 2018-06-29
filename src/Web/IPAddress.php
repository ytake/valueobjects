<?php
declare(strict_types=1);

namespace ValueObjects\Web;

use ValueObjects\Exception\InvalidNativeArgumentException;

/**
 * Class IPAddress
 */
class IPAddress extends Domain
{
    /**
     * Returns a new IPAddress
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $filteredValue = filter_var($value, FILTER_VALIDATE_IP);

        if ($filteredValue === false) {
            throw new InvalidNativeArgumentException($value, array('string (valid ip address)'));
        }

        $this->value = $filteredValue;
    }

    /**
     * Returns the version (IPv4 or IPv6) of the ip address
     *
     * @return IPAddressVersion
     */
    public function getVersion(): IPAddressVersion
    {
        $isIPv4 = filter_var($this->toNative(), FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);

        if (false !== $isIPv4) {
            return IPAddressVersion::IPV4();
        }

        return IPAddressVersion::IPV6();
    }
}
