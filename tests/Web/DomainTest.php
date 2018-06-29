<?php
declare(strict_types=1);

namespace ValueObjects\Tests\Web;

use PHPUnit\Framework\TestCase;
use ValueObjects\Web\Domain;

final class DomainTest extends TestCase
{
    public function testSpecifyType()
    {
        $ip       = Domain::specifyType('127.0.0.1');
        $hostname = Domain::specifyType('example.com');

        $this->assertInstanceOf('ValueObjects\Web\IPAddress', $ip);
        $this->assertInstanceOf('ValueObjects\Web\Hostname', $hostname);
    }
}
