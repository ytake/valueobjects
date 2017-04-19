<?php

namespace ValueObjects\Person;

use ValueObjects\Enum\Enum;

class Gender extends Enum
{
    const MALE   = 'male';
    const FEMALE = 'female';
    const OTHER  = 'other';
}
