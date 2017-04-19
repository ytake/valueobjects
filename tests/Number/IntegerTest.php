<?php

namespace ValueObjects\Tests\Number;

use ValueObjects\Tests\TestCase;
use ValueObjects\Number\Integer;
use ValueObjects\Number\Real;

class IntegerTest extends TestCase
{
    public function testToNative()
    {
        $integer = new Integer(5);
        $this->assertSame(5, $integer->toNative());
    }

    public function testSameValueAs()
    {
        $integer1 = new Integer(3);
        $integer2 = new Integer(3);
        $integer3 = new Integer(45);

        $this->assertTrue($integer1->sameValueAs($integer2));
        $this->assertTrue($integer2->sameValueAs($integer1));
        $this->assertFalse($integer1->sameValueAs($integer3));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($integer1->sameValueAs($mock));
    }

    public function testToString()
    {
        $integer = new Integer(87);
        $this->assertSame('87', $integer->__toString());
    }

    /** @expectedException ValueObjects\Exception\InvalidNativeArgumentException */
    public function testInvalidNativeArgument()
    {
        new Integer(23.4);
    }

    public function testZeroToString()
    {
        $zero = new Integer(0);
        $this->assertSame('0', $zero->__toString());
    }

    public function testToReal()
    {
        $integer    = new Integer(5);
        $nativeReal = new Real(5);
        $real       = $integer->toReal();

        $this->assertTrue($real->sameValueAs($nativeReal));
    }
}
