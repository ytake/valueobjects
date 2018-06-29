<?php
declare(strict_types=1);

namespace ValueObjects\Web;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Number\Natural;

/**
 * Class PortNumber
 */
class PortNumber extends Natural implements PortNumberInterface
{
    /**
     * Returns a PortNumber object.
     *
     * @param int $value
     */
    public function __construct(int $value)
    {
        $options = [
            'options' => [
                'min_range' => 0,
                'max_range' => 65535,
            ],
        ];

        $value = filter_var($value, FILTER_VALIDATE_INT, $options);

        if (false === $value) {
            throw new InvalidNativeArgumentException($value, ['int (>=0, <=65535)']);
        }

        parent::__construct($value);
    }
}
