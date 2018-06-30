<?php

namespace ValueObjects\Tests\Web;

use PHPUnit\Framework\TestCase;
use ValueObjects\Web\SchemeName;

class SchemeNameTest extends TestCase
{
    public function testValidSchemeName()
    {
        $scheme = new SchemeName('git+ssh');
        $this->assertInstanceOf('ValueObjects\Web\SchemeName', $scheme);
    }

    /** @expectedException \ValueObjects\Exception\InvalidNativeArgumentException */
    public function testInvalidSchemeName()
    {
        new SchemeName('ht*tp');
    }
}
