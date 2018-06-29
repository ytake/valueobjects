<?php
declare(strict_types=1);

namespace ValueObjects\Web;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\StringLiteral\StringLiteral;

/**
 * Class Path
 */
class Path extends StringLiteral
{
    /**
     * @param $value
     */
    public function __construct(string $value)
    {
        $filteredValue = parse_url($value, PHP_URL_PATH);

        if (null === $filteredValue || strlen($filteredValue) != strlen($value)) {
            throw new InvalidNativeArgumentException($value, ['string (valid url path)']);
        }

        $this->value = $filteredValue;
    }
}
