<?php
declare(strict_types=1);

namespace ValueObjects\Web;

/**
 * Class NullFragmentIdentifier
 */
class NullFragmentIdentifier extends FragmentIdentifier implements FragmentIdentifierInterface
{
    /**
     * Returns a new NullFragmentIdentifier
     */
    public function __construct()
    {
        $this->value = '';
    }
}
