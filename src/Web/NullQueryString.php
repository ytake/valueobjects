<?php

namespace ValueObjects\Web;

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
