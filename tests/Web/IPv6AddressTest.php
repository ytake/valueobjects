<?php

namespace ValueObjects\Tests\Web;

use ValueObjects\Tests\TestCase;
use ValueObjects\Web\IPv6Address;

class IPv6AddressTest extends TestCase
{
    public function testValidIPv6Address()
    {
        $ip = new IPv6Address('::1');

        $this->assertInstanceOf('ValueObjects\Web\IPv6Address', $ip);
    }

    /** @expectedException ValueObjects\Exception\InvalidNativeArgumentException */
    public function testInvalidIPv6Address()
    {
        new IPv6Address('127.0.0.1');
    }
}
