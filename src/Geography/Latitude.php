<?php

namespace ValueObjects\Geography;

use League\Geotools\Coordinate\Coordinate as BaseCoordinate;
use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Number\Real;

class Latitude extends Real
{

    /**
     * Returns a new Latitude object
     *
     * @param $value
     * @throws InvalidNativeArgumentException
     */
    public function __construct($value)
    {
        $value = \filter_var($value, FILTER_VALIDATE_FLOAT);

        if (false === $value) {
            throw new InvalidNativeArgumentException($value, array('float'));
        }

        // normalization process through Coordinate object
        $coordinate = new BaseCoordinate(array($value, 0));
        $latitude   = $coordinate->getLatitude();

        $this->value = $latitude;
    }
}
