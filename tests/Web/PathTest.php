<?php

namespace ValueObjects\Tests\Web;

use ValueObjects\Tests\TestCase;
use ValueObjects\Web\Path;

class PathTest extends TestCase
{
    public function testValidPath()
    {
        $pathString = '/path/to/resource.ext';
        $path = new Path($pathString);
        $this->assertEquals($pathString, $path->toNative());
    }

    /** @expectedException ValueObjects\Exception\InvalidNativeArgumentException */
    public function testInvalidPath()
    {
        new Path('//valid?');
    }
}
