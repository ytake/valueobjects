<?php

namespace ValueObjects\DateTime;

use ValueObjects\Number\Integer;

class Year extends Integer
{
    /**
     * Returns the current year.
     *
     * @return Year
     */
    public static function now()
    {
        $now  = new \DateTime('now');
        $year = \intval($now->format('Y'));

        return new static($year);
    }
}
