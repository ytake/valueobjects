<?php
declare(strict_types=1);

namespace ValueObjects\Identity;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;
use Ramsey\Uuid\Uuid as BaseUuid;

/**
 * Class UUID
 */
class UUID extends StringLiteral
{
    /** @var BaseUuid */
    protected $value;

    /**
     * @param  ...string                                                 $uuid
     *
     * @return UUID|ValueObjectInterface
     * @throws \ValueObjects\Exception\InvalidNativeArgumentException
     */
    public static function fromNative(): ValueObjectInterface
    {
        $uuid_str = \func_get_arg(0);
        $uuid = new static($uuid_str);

        return $uuid;
    }

    /**
     * Generate a new UUID string
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
     * UUID constructor.
     *
     * @param string|null $value
     */
    public function __construct(string $value = null)
    {
        $uuid_str = BaseUuid::uuid4();

        if (null !== $value) {
            $pattern = '/' . BaseUuid::VALID_PATTERN . '/';

            if (!\preg_match($pattern, $value)) {
                throw new InvalidNativeArgumentException($value, ['UUID string']);
            }

            $uuid_str = $value;
        }

        $this->value = \strval($uuid_str);
    }

    /**
     * Tells whether two UUID are equal by comparing their values
     *
     * @param  UUID|ValueObjectInterface $uuid
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
