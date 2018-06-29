<?php
declare(strict_types=1);

namespace ValueObjects\Web;

use ValueObjects\Enum\Enum;

/**
 * Class IPAddressVersion
 */
class IPAddressVersion extends Enum
{
    const IPV4 = 'IPv4';
    const IPV6 = 'IPv6';
}
