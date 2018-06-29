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

namespace ValueObjects\Geography;

use ValueObjects\Enum\Enum;

/**
 * Class Continent.
 *
 * @method static string AFRICA()
 * @method static string EUROPE()
 * @method static string ASIA()
 * @method static string NORTH_AMERICA()
 * @method static string SOUTH_AMERICA()
 * @method static string ANTARCTICA()
 * @method static string AUSTRALIA()
 */
class Continent extends Enum
{
    const AFRICA = 'Africa';
    const EUROPE = 'Europe';
    const ASIA = 'Asia';
    const NORTH_AMERICA = 'North America';
    const SOUTH_AMERICA = 'South America';
    const ANTARCTICA = 'Antarctica';
    const AUSTRALIA = 'Australia';
}
