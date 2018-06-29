<?php
declare(strict_types=1);

namespace ValueObjects\Geography;

use ValueObjects\Enum\Enum;

/**
 * Class DistanceFormula
 * @method static string FLAT()
 * @method static string HAVERSINE()
 * @method static string VINCENTY()
 */
class DistanceFormula extends Enum
{
    const FLAT      = 'flat';
    const HAVERSINE = 'haversine';
    const VINCENTY  = 'vincenty';
}
