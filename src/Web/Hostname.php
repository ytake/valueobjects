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
use Zend\Validator\Hostname as Validator;

/**
 * Class Hostname.
 */
class Hostname extends Domain
{
    /**
     * Returns a Hostname.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $validator = new Validator(['allow' => Validator::ALLOW_DNS | Validator::ALLOW_LOCAL]);

        if (false === $validator->isValid($value)) {
            throw new InvalidNativeArgumentException($value, ['string (valid hostname)']);
        }

        $this->value = $value;
    }
}
