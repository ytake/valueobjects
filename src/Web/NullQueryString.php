<?php
declare(strict_types=1);

namespace ValueObjects\Web;

/**
 * Class NullQueryString
 */
class NullQueryString extends QueryString implements QueryStringInterface
{
    /**
     * Returns a new NullQueryString
     *
     */
    public function __construct()
    {
        $this->value = '';
    }
}
