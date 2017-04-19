<?php

namespace ValueObjects\Number;

use ValueObjects\Exception\InvalidNativeArgumentException;

class Natural extends Integer
{
    /**
     * Returns a Natural object given a PHP native int as parameter.
     *
     * @param int $value
     */
    public function __construct($value)
    {
        $options = array(
            'options' => array(
                'min_range' => 0
            )
        );

        $value = filter_var($value, FILTER_VALIDATE_INT, $options);

        if (false === $value) {
            throw new InvalidNativeArgumentException($value, array('int (>=0)'));
        }

        parent::__construct($value);
    }
}
