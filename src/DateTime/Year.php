<?php
declare(strict_types=1);

namespace ValueObjects\DateTime;

use ValueObjects\Number\Integer;

/**
 * Class Year
 */
class Year extends Integer
{
    /**
     * Returns the current year.
     *
     * @return Year
     */
    public static function now(): Year
    {
        $now = new \DateTime('now');
        return new static(\intval($now->format('Y')));
    }
}
