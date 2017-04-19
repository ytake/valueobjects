<?php

namespace ValueObjects\Geography;

use ValueObjects\Enum\Enum;

class DistanceFormula extends Enum
{
    const FLAT      = 'flat';
    const HAVERSINE = 'haversine';
    const VINCENTY  = 'vincenty';
}
