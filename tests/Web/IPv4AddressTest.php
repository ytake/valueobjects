<?php

namespace ValueObjects\Tests\Web;

use ValueObjects\Tests\TestCase;
use ValueObjects\Web\IPv4Address;

class IPv4AddressTest extends TestCase
{
    public function testValidIPv4Address()
    {
        $ip = new IPv4Address('127.0.0.1');

        $this->assertInstanceOf('ValueObjects\Web\IPv4Address', $ip);
    }

    /** @expectedException ValueObjects\Exception\InvalidNativeArgumentException */
    public function testInvalidIPv4Address()
    {
        new IPv4Address('::1');
    }
}
