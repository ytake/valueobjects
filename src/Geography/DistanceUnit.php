<?php

namespace ValueObjects\Geography;

use ValueObjects\Enum\Enum;

class DistanceUnit extends Enum
{
    const FOOT      = 'ft';
    const METER     = 'mt';
    const KILOMETER = 'km';
    const MILE      = 'mi';
}
