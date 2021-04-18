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

use ValueObjects\Enum\Enum;

/**
 * Class IPAddressVersion.
 * @method IPAddressVersion IPV4()
 * @method IPAddressVersion IPV6()
 */
class IPAddressVersion extends Enum
{
    public const IPV4 = 'IPv4';
    public const IPV6 = 'IPv6';
}
