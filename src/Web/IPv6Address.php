<?php

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

declare(strict_types=1);

namespace ValueObjects\Web;

use ValueObjects\Exception\InvalidNativeArgumentException;

use function filter_var;

use const FILTER_FLAG_IPV6;
use const FILTER_VALIDATE_IP;

/**
 * Class IPv6Address.
 */
class IPv6Address extends IPAddress
{
    /**
     * Returns a new IPv6Address.
     *
     * @param string $value
     */
    public function __construct(
        string $value
    ) {
        $filteredValue = filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);
        if (false === $filteredValue) {
            throw new InvalidNativeArgumentException(
                $value,
                ['string (valid ipv6 address)']
            );
        }
        $this->value = $filteredValue;
    }
}
