<?php

namespace ValueObjects\DateTime\Exception;

class InvalidDateException extends \Exception
{
    public function __construct($year, $month, $day)
    {
        $date    = \sprintf('%d-%d-%d', $year, $month, $day);
        $message = \sprintf('The date "%s" is invalid.', $date);
        parent::__construct($message);
    }
}
