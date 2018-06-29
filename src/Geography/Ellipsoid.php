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
 * Class Ellipsoid.
 *
 * @method static string AIRY()
 * @method static string AUSTRALIAN_NATIONAL()
 * @method static string BESSEL_1841()
 * @method static string BESSEL_1841_NAMBIA()
 * @method static string CLARKE_1866()
 * @method static string CLARKE_1880()
 * @method static string EVEREST()
 * @method static string FISCHER_1960_MERCURY()
 * @method static string FISCHER_1968()
 * @method static string GRS_1967()
 * @method static string GRS_1980()
 * @method static string HELMERT_1906()
 * @method static string HOUGH()
 * @method static string INTERNATIONAL()
 * @method static string KRASSOVSKY()
 * @method static string MODIFIED_AIRY()
 * @method static string MODIFIED_EVEREST()
 * @method static string MODIFIED_FISCHER_1960()
 * @method static string SOUTH_AMERICAN_1969()
 * @method static string WGS60()
 * @method static string WGS66()
 * @method static string WGS72()
 * @method static string WGS84()
 */
class Ellipsoid extends Enum
{
    const AIRY = 'AIRY';
    const AUSTRALIAN_NATIONAL = 'AUSTRALIAN_NATIONAL';
    const BESSEL_1841 = 'BESSEL_1841';
    const BESSEL_1841_NAMBIA = 'BESSEL_1841_NAMBIA';
    const CLARKE_1866 = 'CLARKE_1866';
    const CLARKE_1880 = 'CLARKE_1880';
    const EVEREST = 'EVEREST';
    const FISCHER_1960_MERCURY = 'FISCHER_1960_MERCURY';
    const FISCHER_1968 = 'FISCHER_1968';
    const GRS_1967 = 'GRS_1967';
    const GRS_1980 = 'GRS_1980';
    const HELMERT_1906 = 'HELMERT_1906';
    const HOUGH = 'HOUGH';
    const INTERNATIONAL = 'INTERNATIONAL';
    const KRASSOVSKY = 'KRASSOVSKY';
    const MODIFIED_AIRY = 'MODIFIED_AIRY';
    const MODIFIED_EVEREST = 'MODIFIED_EVEREST';
    const MODIFIED_FISCHER_1960 = 'MODIFIED_FISCHER_1960';
    const SOUTH_AMERICAN_1969 = 'SOUTH_AMERICAN_1969';
    const WGS60 = 'WGS60';
    const WGS66 = 'WGS66';
    const WGS72 = 'WGS72';
    const WGS84 = 'WGS84';
}
