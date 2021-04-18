<?php

declare(strict_types=1);

namespace ValueObjects\Tests\Web;

use PHPUnit\Framework\TestCase;
use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Web\Path;

class PathTest extends TestCase
{
    public function testValidPath(): void
    {
        $pathString = '/path/to/resource.ext';
        $path = new Path($pathString);
        $this->assertEquals($pathString, $path->toNative());
    }

    public function testInvalidPath(): void
    {
        $this->expectException(InvalidNativeArgumentException::class);
        new Path('//valid?');
    }
}
