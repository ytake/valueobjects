<?php

namespace ValueObjects\Tests\Person;

use ValueObjects\Person\Name;
use ValueObjects\Tests\TestCase;
use ValueObjects\StringLiteral\StringLiteral;

class NameTest extends TestCase
{
    private $name;

    public function setup()
    {
        $this->name = new Name(new StringLiteral('foo'), new StringLiteral('bar'), new StringLiteral('baz'));
    }

    public function testFromNative()
    {
        $fromNativeName  = Name::fromNative('foo', 'bar', 'baz');

        $this->assertTrue($fromNativeName->sameValueAs($this->name));
    }

    public function testGetFirstName()
    {
        $this->assertEquals('foo', $this->name->getFirstName());
    }

    public function testGetMiddleName()
    {
        $this->assertEquals('bar', $this->name->getMiddleName());
    }

    public function testGetLastName()
    {
        $this->assertEquals('baz', $this->name->getLastName());
    }

    public function testGetFullName()
    {
        $this->assertEquals('foo bar baz', $this->name->getFullName());
    }

    public function testEmptyFullName()
    {
        $name = new Name(new StringLiteral(''), new StringLiteral(''), new StringLiteral(''));

        $this->assertEquals('', $name->getFullName());
    }

    public function testSameValueAs()
    {
        $name2 = new Name(new StringLiteral('foo'), new StringLiteral('bar'), new StringLiteral('baz'));
        $name3 = new Name(new StringLiteral('foo'), new StringLiteral(''), new StringLiteral('baz'));

        $this->assertTrue($this->name->sameValueAs($name2));
        $this->assertTrue($name2->sameValueAs($this->name));
        $this->assertFalse($this->name->sameValueAs($name3));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($this->name->sameValueAs($mock));
    }

    public function testToString()
    {
        $this->assertEquals('foo bar baz', $this->name->__toString());
    }
}
