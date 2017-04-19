<?php

namespace ValueObjects\Tests\Number;

use ValueObjects\Tests\TestCase;
use ValueObjects\Number\Real;
use ValueObjects\Number\Integer;
use ValueObjects\Number\Natural;

class RealTest extends TestCase
{
    public function testFromNative()
    {
        $fromNativeReal  = Real::fromNative(.056);
        $constructedReal = new Real(.056);

        $this->assertTrue($fromNativeReal->sameValueAs($constructedReal));
    }

    public function testToNative()
    {
        $real = new Real(3.4);
        $this->assertEquals(3.4, $real->toNative());
    }

    public function testSameValueAs()
    {
        $real1 = new Real(5.64);
        $real2 = new Real(5.64);
        $real3 = new Real(6.01);

        $this->assertTrue($real1->sameValueAs($real2));
        $this->assertTrue($real2->sameValueAs($real1));
        $this->assertFalse($real1->sameValueAs($real3));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($real1->sameValueAs($mock));
    }

    /** @expectedException ValueObjects\Exception\InvalidNativeArgumentException */
    public function testInvalidNativeArgument()
    {
        new Real('invalid');
    }

    public function testToInteger()
    {
        $real          = new Real(3.14);
        $nativeInteger = new Integer(3);
        $integer       = $real->toInteger();

        $this->assertTrue($integer->sameValueAs($nativeInteger));
    }

    public function testToNatural()
    {
        $real          = new Real(3.14);
        $nativeNatural = new Natural(3);
        $natural       = $real->toNatural();

        $this->assertTrue($natural->sameValueAs($nativeNatural));
    }

    public function testToString()
    {
        $real = new Real(.7);
        $this->assertEquals('.7', $real->__toString());
    }
}
