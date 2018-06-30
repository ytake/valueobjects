<?php
declare(strict_types=1);

/**
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 * Copyright (c) 2018 Yuuki Takezawa
 */

namespace ValueObjects\Web;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\StringLiteral\StringLiteral;

/**
 * Class EmailAddress.
 */
class EmailAddress extends StringLiteral
{
    /**
     * Returns an EmailAddress object given a PHP native string as parameter.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $filteredValue = filter_var($value, FILTER_VALIDATE_EMAIL);

        if (false === $filteredValue) {
            throw new InvalidNativeArgumentException($value, ['string (valid email address)']);
        }

        $this->value = $filteredValue;
    }

    /**
     * Returns the local part of the email address.
     *
     * @return StringLiteral
     */
    public function getLocalPart(): StringLiteral
    {
        $parts = explode('@', $this->toNative());

        return new StringLiteral($parts[0]);
    }

    /**
     * Returns the domain part of the email address.
     *
     * @return Domain
     */
    public function getDomainPart(): Domain
    {
        $parts = \explode('@', $this->toNative());
        $domain = \trim($parts[1], '[]');

        return Domain::specifyType($domain);
    }
}
