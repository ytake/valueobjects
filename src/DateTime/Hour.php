<?php
declare(strict_types=1);

namespace ValueObjects\DateTime;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Number\Natural;
use ValueObjects\ValueObjectInterface;

/**
 * Class Hour
 */
class Hour extends Natural
{
    const MIN_HOUR = 0;
    const MAX_HOUR = 23;

    /**
     * Returns a new Hour from native int value
     *
     * @param  ...int  $value
     *
     * @return Hour|ValueObjectInterface
     */
    public static function fromNative(): ValueObjectInterface
    {
        $value = func_get_arg(0);
        return new static($value);
    }

    /**
     * Returns a new Hour object
     *
     * @param int $value
     */
    public function __construct(int $value)
    {
        $options = [
            'options' => ['min_range' => self::MIN_HOUR, 'max_range' => self::MAX_HOUR]
        ];

        $value = filter_var($value, FILTER_VALIDATE_INT, $options);

        if (false === $value) {
            throw new InvalidNativeArgumentException($value, ['int (>=0, <=23)']);
        }

        parent::__construct($value);
    }

    /**
     * Returns the current hour.
     *
     * @return Hour
     */
    public static function now(): Hour
    {
        $now = new \DateTime('now');
        $hour = \intval($now->format('G'));

        return new static($hour);
    }
}
