<?php

namespace ValueObjects\Web;

use ValueObjects\StringLiteral\StringLiteral;

abstract class Domain extends StringLiteral
{
    /**
     * Returns a Hostname or a IPAddress object depending on passed value
     *
     * @param $domain
     * @return Hostname|IPAddress
     */
    public static function specifyType($domain)
    {
        if (false !== filter_var($domain, FILTER_VALIDATE_IP)) {
            return new IPAddress($domain);
        }

        return new Hostname($domain);
    }
}
