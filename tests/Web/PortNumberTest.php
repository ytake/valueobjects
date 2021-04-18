<?php

declare(strict_types=1);

namespace ValueObjects\Tests\Web;

use PHPUnit\Framework\TestCase;
use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Web\PortNumber;

class PortNumberTest extends TestCase
{
    public function testValidPortNumber(): void
    {
        $port = new PortNumber(80);
        $this->assertInstanceOf('ValueObjects\Web\PortNumber', $port);
    }

    public function testInvalidPortNumber(): void
    {
        $this->expectException(InvalidNativeArgumentException::class);
        new PortNumber(65536);
    }
}
