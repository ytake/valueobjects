<?php
declare(strict_types=1);

namespace ValueObjects\Geography;

use ValueObjects\Enum\Enum;

/**
 * Class Continent
 *
 * @method static string AFRICA()
 * @method static string EUROPE()
 * @method static string ASIA()
 * @method static string NORTH_AMERICA()
 * @method static string SOUTH_AMERICA()
 * @method static string ANTARCTICA()
 * @method static string AUSTRALIA()
 */
class Continent extends Enum
{
    const AFRICA        = 'Africa';
    const EUROPE        = 'Europe';
    const ASIA          = 'Asia';
    const NORTH_AMERICA = 'North America';
    const SOUTH_AMERICA = 'South America';
    const ANTARCTICA    = 'Antarctica';
    const AUSTRALIA     = 'Australia';
}
