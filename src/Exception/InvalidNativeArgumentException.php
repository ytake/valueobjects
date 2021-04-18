<?php

/**
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 * Copyright (c) 2018 Yuuki Takezawa
 */

declare(strict_types=1);

namespace ValueObjects\Exception;

use InvalidArgumentException;

use function implode;
use function sprintf;

/**
 * Class InvalidNativeArgumentException.
 */
final class InvalidNativeArgumentException extends InvalidArgumentException
{
    /**
     * @param string $value
     * @param array<string> $allowedTypes
     */
    public function __construct(
        string $value,
        array $allowedTypes
    ) {
        parent::__construct(
            sprintf(
                'Argument "%s" is invalid. Allowed types for argument are "%s".',
                $value,
                implode(', ', $allowedTypes)
            )
        );
    }
}
