<?php
declare(strict_types=1);

namespace ValueObjects\Web;

use ValueObjects\Structure\Dictionary;

/**
 * Interface QueryStringInterface
 */
interface QueryStringInterface
{
    /**
     * @return Dictionary
     */
    public function toDictionary(): Dictionary;
}
