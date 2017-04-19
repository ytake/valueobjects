<?php

namespace ValueObjects\Tests\Number;

use ValueObjects\Person\Age;
use ValueObjects\Tests\TestCase;

class AgeTest extends TestCase
{
    public function testToNative()
    {
        $age = new Age(25);
        $this->assertEquals(25, $age->toNative());
    }

    public function testSameValueAs()
    {
        $age1 = new Age(33);
        $age2 = new Age(33);
        $age3 = new Age(66);

        $this->assertTrue($age1->sameValueAs($age2));
        $this->assertTrue($age2->sameValueAs($age1));
        $this->assertFalse($age1->sameValueAs($age3));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($age1->sameValueAs($mock));
    }

    public function testToString()
    {
        $age = new Age(54);
        $this->assertEquals('54', $age->__toString());
    }
}
