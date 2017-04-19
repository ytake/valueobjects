<?php

namespace ValueObjects\Web;

use ValueObjects\Enum\Enum;

class IPAddressVersion extends Enum
{
    const IPV4 = 'IPv4';
    const IPV6 = 'IPv6';
}
