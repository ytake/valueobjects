<?php

namespace ValueObjects\Tests\Web;

use ValueObjects\Tests\TestCase;
use ValueObjects\Web\Hostname;

class HostnameTest extends TestCase
{
    /** @expectedException ValueObjects\Exception\InvalidNativeArgumentException */
    public function testInvalidHostname()
    {
        new Hostname('inv@lìd');
    }
}
