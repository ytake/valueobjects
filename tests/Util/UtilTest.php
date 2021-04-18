<?php

declare(strict_types=1);

namespace ValueObjects\Tests\Util;

use PHPUnit\Framework\TestCase;
use ValueObjects\Util\Util;

class UtilTest extends TestCase
{
    public function testClassEquals(): void
    {
        $util1 = new Util();
        $util2 = new Util();

        $this->assertTrue(Util::classEquals($util1, $util2));
        $this->assertFalse(Util::classEquals($util1, $this));
    }

    public function testGetClassAsString(): void
    {
        $util = new Util();
        $this->assertEquals('ValueObjects\Util\Util', Util::getClassAsString($util));
    }
}
