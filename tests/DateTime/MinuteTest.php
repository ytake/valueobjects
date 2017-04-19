<?php

namespace ValueObjects\Tests\DateTime;

use ValueObjects\Tests\TestCase;
use ValueObjects\DateTime\Minute;

class MinuteTest extends TestCase
{
    public function testFromNative()
    {
        $fromNativeMinute  = Minute::fromNative(11);
        $constructedMinute = new Minute(11);

        $this->assertTrue($fromNativeMinute->sameValueAs($constructedMinute));
    }

    public function testNow()
    {
        $minute = Minute::now();
        $this->assertEquals(\intval(date('i')), $minute->toNative());
    }

    /** @expectedException ValueObjects\Exception\InvalidNativeArgumentException */
    public function testInvalidMinute()
    {
        new Minute(60);
    }

}
