<?php

namespace ValueObjects\Tests\Number;

use ValueObjects\Number\Natural;
use ValueObjects\Tests\TestCase;

class NaturalTest extends TestCase
{
    /** @expectedException ValueObjects\Exception\InvalidNativeArgumentException */
    public function testInvalidNativeArgument()
    {
        new Natural(-2);
    }
}
