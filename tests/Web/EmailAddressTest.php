<?php

namespace ValueObjects\Tests\Web;

use ValueObjects\Tests\TestCase;
use ValueObjects\Web\EmailAddress;

class EmailAddressTest extends TestCase
{
    public function testValidEmailAddress()
    {
        $email1 = new EmailAddress('foo@bar.com');
        $this->assertInstanceOf('ValueObjects\Web\EmailAddress', $email1);

        $email2 = new EmailAddress('foo@[120.0.0.1]');
        $this->assertInstanceOf('ValueObjects\Web\EmailAddress', $email2);
    }

    /** @expectedException ValueObjects\Exception\InvalidNativeArgumentException */
    public function testInvalidEmailAddress()
    {
        new EmailAddress('invalid');
    }

    public function testGetLocalPart()
    {
        $email = new EmailAddress('foo@bar.baz');
        $localPart = $email->getLocalPart();

        $this->assertEquals('foo', $localPart->toNative());
    }

    public function testGetDomainPart()
    {
        $email = new EmailAddress('foo@bar.com');
        $domainPart = $email->getDomainPart();

        $this->assertEquals('bar.com', $domainPart->toNative());
        $this->assertInstanceOf('ValueObjects\Web\Domain', $domainPart);
    }
}
