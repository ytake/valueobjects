<?php

namespace ValueObjects\Tests\NullValue;

use ValueObjects\Tests\TestCase;
use ValueObjects\NullValue\NullValue;

class NullValueTest extends TestCase
{
    /** @expectedException \BadMethodCallException */
    public function testFromNative()
    {
        NullValue::fromNative();
    }

    public function testSameValueAs()
    {
        $null1 = new NullValue();
        $null2 = new NullValue();

        $this->assertTrue($null1->sameValueAs($null2));
    }

    public function testCreate()
    {
        $null = NullValue::create();

        $this->assertInstanceOf('ValueObjects\NullValue\NullValue', $null);
    }

    public function testToString()
    {
        $foo = new NullValue();
        $this->assertSame('', $foo->__toString());
    }
}
