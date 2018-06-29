<?php

namespace ValueObjects\Tests\DateTime;

use PHPUnit\Framework\TestCase;
use ValueObjects\DateTime\Year;

class YearTest extends TestCase
{
    public function testNow()
    {
        $year = Year::now();
        $this->assertEquals(date('Y'), $year->toNative());
    }

}
