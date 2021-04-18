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

use ValueObjects\StringLiteral\StringLiteral;

use function filter_var;

use const FILTER_VALIDATE_IP;

abstract class Domain extends StringLiteral
{
    /**
     * Returns a Hostname or a IPAddress object depending on passed value.
     *
     * @param string $domain
     * @return Domain
     */
    public static function specifyType(
        string $domain
    ): Domain {
        if (false !== filter_var($domain, FILTER_VALIDATE_IP)) {
            return new IPAddress($domain);
        }
        return new Hostname($domain);
    }
}
