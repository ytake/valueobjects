<?php

namespace ValueObjects\Web;

class NullFragmentIdentifier extends FragmentIdentifier implements FragmentIdentifierInterface
{
    /**
     * Returns a new NullFragmentIdentifier
     *
     */
    public function __construct()
    {
        $this->value = '';
    }
}
