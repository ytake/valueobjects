<?php

namespace ValueObjects\Tests\Number;

use ValueObjects\Person\Gender;
use PHPUnit\Framework\TestCase;
use ValueObjects\ValueObjectInterface;

class GenderTest extends TestCase
{
    public function testToNative()
    {
        $gender = Gender::FEMALE();
        $this->assertEquals(Gender::FEMALE, $gender->toNative());
    }

    public function testSameValueAs()
    {
        $male1 = Gender::MALE();
        $male2 = Gender::MALE();
        $other = Gender::OTHER();

        $this->assertTrue($male1->sameValueAs($male2));
        $this->assertTrue($male2->sameValueAs($male1));
        $this->assertFalse($male1->sameValueAs($other));

        $mock = $this->getMockBuilder(ValueObjectInterface::class)
            ->getMock();
        $this->assertFalse($male1->sameValueAs($mock));
    }

    public function testToString()
    {
        $sex = Gender::FEMALE();
        $this->assertEquals('female', $sex->__toString());
    }
}
