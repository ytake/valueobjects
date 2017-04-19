<?php

namespace ValueObjects\Tests\Geography;

use ValueObjects\Geography\Street;
use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Tests\TestCase;

class StreetTest extends TestCase
{
    protected $street;

    public function setup()
    {
        $this->street = new Street(new StringLiteral('Abbey Rd'), new StringLiteral('3'), new StringLiteral('Building A'), new StringLiteral('%number% %name%, %elements%'));
    }

    public function testFromNative()
    {
        $fromNativeStreet  = Street::fromNative('Abbey Rd', '3', 'Building A');
        $this->assertTrue($this->street->sameValueAs($fromNativeStreet));
    }

    /** @expectedException \BadMethodCallException */
    public function testInvalidFromNative()
    {
        Street::fromNative('Abbey Rd');
    }

    public function testSameValueAs()
    {
        $street2 = new Street(new StringLiteral('Abbey Rd'), new StringLiteral('3'), new StringLiteral('Building A'));
        $street3 = new Street(new StringLiteral('Orchard Road'), new StringLiteral(''));

        $this->assertTrue($this->street->sameValueAs($street2));
        $this->assertTrue($street2->sameValueAs($this->street));
        $this->assertFalse($this->street->sameValueAs($street3));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($this->street->sameValueAs($mock));
    }

    public function testGetName()
    {
        $name = new StringLiteral('Abbey Rd');
        $this->assertTrue($this->street->getName()->sameValueAs($name));
    }

    public function testGetNumber()
    {
        $number = new StringLiteral('3');
        $this->assertTrue($this->street->getNumber()->sameValueAs($number));
    }

    public function testGetElements()
    {
        $elements = new StringLiteral('Building A');
        $this->assertTrue($this->street->getElements()->sameValueAs($elements));
    }

    public function testToString()
    {
        $this->assertSame('3 Abbey Rd, Building A', $this->street->__toString());
    }
}
