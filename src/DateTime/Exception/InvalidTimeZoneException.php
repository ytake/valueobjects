<?php

namespace ValueObjects\DateTime\Exception;

class InvalidTimeZoneException extends \Exception
{
    public function __construct($name)
    {
        $message = \sprintf('The timezone "%s" is invalid. Check "timezone_identifiers_list()" for valid values.', $name);
        parent::__construct($message);
    }
}
