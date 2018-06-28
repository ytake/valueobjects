<?php
declare(strict_types=1);

namespace ValueObjects\Number;

use ValueObjects\Enum\Enum;

/**
 * Class RoundingMode
 *
 * @method static int HALF_UP()
 * @method static int HALF_DOWN()
 * @method static int HALF_EVEN()
 * @method static int HALF_ODD()
 */
class RoundingMode extends Enum
{
    const HALF_UP   = PHP_ROUND_HALF_UP;
    const HALF_DOWN = PHP_ROUND_HALF_DOWN;
    const HALF_EVEN = PHP_ROUND_HALF_EVEN;
    const HALF_ODD  = PHP_ROUND_HALF_ODD;
}
