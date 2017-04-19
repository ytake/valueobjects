<?php

namespace ValueObjects\Tests\Number;

use ValueObjects\Number\Real;
use ValueObjects\Tests\TestCase;
use ValueObjects\Number\Complex;

class ComplexTest extends TestCase
{
    /** @var Complex */
    private $complex;

    public function setup()
    {
        $this->complex = new Complex(new Real(2.05), new Real(3.2));
    }

    public function testFromNative()
    {
        $fromNativeComplex = Complex::fromNative(2.05, 3.2);

        $this->assertTrue($fromNativeComplex->sameValueAs($this->complex));
    }

    public function testFromNativeWithWrongNumberOfArgsThrowsError()
    {
        $this->setExpectedException('BadMethodCallException');
        $fromNativeComplex = Complex::fromNative(2.05);
    }

    public function testFromPolar()
    {
        $mod = new Real(3.800328933132);
        $arg = new Real(1.0010398733119);
        $fromPolar = Complex::fromPolar($mod, $arg);

        $nativeModulus  = $this->complex->getModulus();
        $nativeArgument = $this->complex->getArgument();

        $this->assertTrue($nativeModulus->sameValueAs($fromPolar->getModulus()));
        $this->assertTrue($nativeArgument->sameValueAs($fromPolar->getArgument()));
    }

    public function testToNative()
    {
        $this->assertEquals(array(2.05, 3.2), $this->complex->toNative());
    }

    public function testGetReal()
    {
        $real = new Real(2.05);

        $this->assertTrue($real->sameValueAs($this->complex->getReal()));
    }

    public function testGetIm()
    {
        $im = new Real(3.2);

        $this->assertTrue($im->sameValueAs($this->complex->getIm()));
    }

    public function testGetModulus()
    {
        $mod = new Real(3.800328933132);

        $this->assertTrue($mod->sameValueAs($this->complex->getModulus()));
    }

    public function testGetArgument()
    {
        $arg = new Real(1.0010398733119);

        $this->assertTrue($arg->sameValueAs($this->complex->getArgument()));
    }

    public function testToString()
    {
        $complex = new Complex(new Real(2.034), new Real(-1.4));
        $this->assertEquals('2.034 - 1.4i', $complex->__toString());
    }

    public function testNotSameValue()
    {
        $this->assertFalse($this->complex->sameValueAs(new Real(2.035)));
    }
}
