<?php
declare(strict_types=1);

namespace ValueObjects\Person;

use ValueObjects\Enum\Enum;

/**
 * Class Gender
 *
 * @method static string MALE()
 * @method static string FEMALE()
 * @method static string OTHER()
 */
class Gender extends Enum
{
    const MALE   = 'male';
    const FEMALE = 'female';
    const OTHER  = 'other';
}
