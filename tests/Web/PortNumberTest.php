<?php

namespace ValueObjects\Tests\Web;

use ValueObjects\Tests\TestCase;
use ValueObjects\Web\PortNumber;

class PortNumberTest extends TestCase
{
    public function testValidPortNumber()
    {
        $port = new PortNumber(80);

        $this->assertInstanceOf('ValueObjects\Web\PortNumber', $port);
    }

    /** @expectedException ValueObjects\Exception\InvalidNativeArgumentException */
    public function testInvalidPortNumber()
    {
        new PortNumber(65536);
    }
}
