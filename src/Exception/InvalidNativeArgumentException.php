<?php
declare(strict_types=1);

namespace ValueObjects\Exception;

/**
 * Class InvalidNativeArgumentException
 */
final class InvalidNativeArgumentException extends \InvalidArgumentException
{
    /**
     * InvalidNativeArgumentException constructor.
     *
     * @param       $value
     * @param array $allowedTypes
     */
    public function __construct($value, array $allowedTypes)
    {
        $this->message = sprintf('Argument "%s" is invalid. Allowed types for argument are "%s".',
            $value,
            implode(', ', $allowedTypes)
        );
    }
}
