<?php
declare(strict_types=1);

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

namespace ValueObjects\Identity;

use Ramsey\Uuid\Uuid as BaseUuid;
use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

/**
 * Class UUID.
 */
class UUID extends StringLiteral
{
    /** @var BaseUuid */
    protected $value;

    /**
     * UUID constructor.
     *
     * @param string|null $value
     */
    public function __construct(string $value = null)
    {
        $uuid_str = BaseUuid::uuid4();

        if (null !== $value) {
            $pattern = '/'.BaseUuid::VALID_PATTERN.'/';

            if (!\preg_match($pattern, $value)) {
                throw new InvalidNativeArgumentException($value, ['UUID string']);
            }

            $uuid_str = $value;
        }

        $this->value = \strval($uuid_str);
    }

    /**
     * @param string $uuid
     *
     * @throws \ValueObjects\Exception\InvalidNativeArgumentException
     *
     * @return UUID|ValueObjectInterface
     */
    public static function fromNative(): ValueObjectInterface
    {
        $uuid_str = \func_get_arg(0);
        $uuid = new static($uuid_str);

        return $uuid;
    }

    /**
     * Generate a new UUID string.
     *
     * @return string
     */
    public static function generateAsString(): string
    {
        $uuid = new static();
        $uuidString = $uuid->toNative();

        return $uuidString;
    }

    /**
     * Tells whether two UUID are equal by comparing their values.
     *
     * @param UUID|ValueObjectInterface $uuid
     *
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $uuid): bool
    {
        if (false === Util::classEquals($this, $uuid)) {
            return false;
        }

        return $this->toNative() === $uuid->toNative();
    }
}
