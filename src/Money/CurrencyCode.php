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

namespace ValueObjects\Money;

use ValueObjects\Enum\Enum;

/**
 * Class CurrencyCode.
 *
 * @method static string AED()
 * @method static string AFN()
 * @method static string AL()
 * @method static string AMD()
 * @method static string ANG()
 * @method static string AOA()
 * @method static string ARS()
 * @method static string AUD()
 * @method static string AWG()
 * @method static string AZN()
 * @method static string BAM()
 * @method static string BBD()
 * @method static string BDT()
 * @method static string BGN()
 * @method static string BHD()
 * @method static string BIF()
 * @method static string BMD()
 * @method static string BND()
 * @method static string BOB()
 * @method static string BRL()
 * @method static string BSD()
 * @method static string BTN()
 * @method static string BWP()
 * @method static string BYR()
 * @method static string BZD()
 * @method static string CAD()
 * @method static string CDF()
 * @method static string CHF()
 * @method static string CLF()
 * @method static string CLP()
 * @method static string CNY()
 * @method static string COP()
 * @method static string CRC()
 * @method static string CUP()
 * @method static string CVE()
 * @method static string CZK()
 * @method static string DJF()
 * @method static string DKK()
 * @method static string DOP()
 * @method static string DZD()
 * @method static string EEK()
 * @method static string EGP()
 * @method static string ETB()
 * @method static string EUR()
 * @method static string FJD()
 * @method static string FKP()
 * @method static string GBP()
 * @method static string GEL()
 * @method static string GHS()
 * @method static string GIP()
 * @method static string GMD()
 * @method static string GNF()
 * @method static string GTQ()
 * @method static string GYD()
 * @method static string HKD()
 * @method static string HNL()
 * @method static string HRK()
 * @method static string HTG()
 * @method static string HUF()
 * @method static string IDR()
 * @method static string ILS()
 * @method static string INR()
 * @method static string IQD()
 * @method static string IRR()
 * @method static string ISK()
 * @method static string JEP()
 * @method static string JMD()
 * @method static string JOD()
 * @method static string JPY()
 * @method static string KES()
 * @method static string KGS()
 * @method static string KHR()
 * @method static string KMF()
 * @method static string KPW()
 * @method static string KRW()
 * @method static string KWD()
 * @method static string KYD()
 * @method static string KZT()
 * @method static string LAK()
 * @method static string LBP()
 * @method static string LKR()
 * @method static string LRD()
 * @method static string LSL()
 * @method static string LTL()
 * @method static string LVL()
 * @method static string LYD()
 * @method static string MAD()
 * @method static string MDL()
 * @method static string MGA()
 * @method static string MKD()
 * @method static string MMK()
 * @method static string MNT()
 * @method static string MOP()
 * @method static string MRO()
 * @method static string MUR()
 * @method static string MVR()
 * @method static string MWK()
 * @method static string MXN()
 * @method static string MYR()
 * @method static string MZN()
 * @method static string NAD()
 * @method static string NGN()
 * @method static string NIO()
 * @method static string NOK()
 * @method static string NPR()
 * @method static string NZD()
 * @method static string OMR()
 * @method static string PAB()
 * @method static string PEN()
 * @method static string PGK()
 * @method static string PHP()
 * @method static string PKR()
 * @method static string PLN()
 * @method static string PYG()
 * @method static string QAR()
 * @method static string RON()
 * @method static string RSD()
 * @method static string RUB()
 * @method static string RWF()
 * @method static string SAR()
 * @method static string SBD()
 * @method static string SCR()
 * @method static string SDG()
 * @method static string SEK()
 * @method static string SGD()
 * @method static string SHP()
 * @method static string SLL()
 * @method static string SOS()
 * @method static string SRD()
 * @method static string STD()
 * @method static string SVC()
 * @method static string SYP()
 * @method static string SZL()
 * @method static string THB()
 * @method static string TJS()
 * @method static string TMT()
 * @method static string TND()
 * @method static string TOP()
 * @method static string TRY_()
 * @method static string TTD()
 * @method static string TWD()
 * @method static string TZS()
 * @method static string UAH()
 * @method static string UGX()
 * @method static string USD()
 * @method static string UYU()
 * @method static string UZS()
 * @method static string VEF()
 * @method static string VND()
 * @method static string VUV()
 * @method static string WST()
 * @method static string XAF()
 * @method static string XCD()
 * @method static string XDR()
 * @method static string XOF()
 * @method static string XPF()
 * @method static string YER()
 * @method static string ZAR()
 * @method static string ZMK()
 * @method static string ZW()
 */
class CurrencyCode extends Enum
{
    const AED = 'AED';
    const AFN = 'AFN';
    const ALL = 'ALL';
    const AMD = 'AMD';
    const ANG = 'ANG';
    const AOA = 'AOA';
    const ARS = 'ARS';
    const AUD = 'AUD';
    const AWG = 'AWG';
    const AZN = 'AZN';
    const BAM = 'BAM';
    const BBD = 'BBD';
    const BDT = 'BDT';
    const BGN = 'BGN';
    const BHD = 'BHD';
    const BIF = 'BIF';
    const BMD = 'BMD';
    const BND = 'BND';
    const BOB = 'BOB';
    const BRL = 'BRL';
    const BSD = 'BSD';
    const BTN = 'BTN';
    const BWP = 'BWP';
    const BYR = 'BYR';
    const BZD = 'BZD';
    const CAD = 'CAD';
    const CDF = 'CDF';
    const CHF = 'CHF';
    const CLF = 'CLF';
    const CLP = 'CLP';
    const CNY = 'CNY';
    const COP = 'COP';
    const CRC = 'CRC';
    const CUP = 'CUP';
    const CVE = 'CVE';
    const CZK = 'CZK';
    const DJF = 'DJF';
    const DKK = 'DKK';
    const DOP = 'DOP';
    const DZD = 'DZD';
    const EEK = 'EEK';
    const EGP = 'EGP';
    const ETB = 'ETB';
    const EUR = 'EUR';
    const FJD = 'FJD';
    const FKP = 'FKP';
    const GBP = 'GBP';
    const GEL = 'GEL';
    const GHS = 'GHS';
    const GIP = 'GIP';
    const GMD = 'GMD';
    const GNF = 'GNF';
    const GTQ = 'GTQ';
    const GYD = 'GYD';
    const HKD = 'HKD';
    const HNL = 'HNL';
    const HRK = 'HRK';
    const HTG = 'HTG';
    const HUF = 'HUF';
    const IDR = 'IDR';
    const ILS = 'ILS';
    const INR = 'INR';
    const IQD = 'IQD';
    const IRR = 'IRR';
    const ISK = 'ISK';
    const JEP = 'JEP';
    const JMD = 'JMD';
    const JOD = 'JOD';
    const JPY = 'JPY';
    const KES = 'KES';
    const KGS = 'KGS';
    const KHR = 'KHR';
    const KMF = 'KMF';
    const KPW = 'KPW';
    const KRW = 'KRW';
    const KWD = 'KWD';
    const KYD = 'KYD';
    const KZT = 'KZT';
    const LAK = 'LAK';
    const LBP = 'LBP';
    const LKR = 'LKR';
    const LRD = 'LRD';
    const LSL = 'LSL';
    const LTL = 'LTL';
    const LVL = 'LVL';
    const LYD = 'LYD';
    const MAD = 'MAD';
    const MDL = 'MDL';
    const MGA = 'MGA';
    const MKD = 'MKD';
    const MMK = 'MMK';
    const MNT = 'MNT';
    const MOP = 'MOP';
    const MRO = 'MRO';
    const MUR = 'MUR';
    const MVR = 'MVR';
    const MWK = 'MWK';
    const MXN = 'MXN';
    const MYR = 'MYR';
    const MZN = 'MZN';
    const NAD = 'NAD';
    const NGN = 'NGN';
    const NIO = 'NIO';
    const NOK = 'NOK';
    const NPR = 'NPR';
    const NZD = 'NZD';
    const OMR = 'OMR';
    const PAB = 'PAB';
    const PEN = 'PEN';
    const PGK = 'PGK';
    const PHP = 'PHP';
    const PKR = 'PKR';
    const PLN = 'PLN';
    const PYG = 'PYG';
    const QAR = 'QAR';
    const RON = 'RON';
    const RSD = 'RSD';
    const RUB = 'RUB';
    const RWF = 'RWF';
    const SAR = 'SAR';
    const SBD = 'SBD';
    const SCR = 'SCR';
    const SDG = 'SDG';
    const SEK = 'SEK';
    const SGD = 'SGD';
    const SHP = 'SHP';
    const SLL = 'SLL';
    const SOS = 'SOS';
    const SRD = 'SRD';
    const STD = 'STD';
    const SVC = 'SVC';
    const SYP = 'SYP';
    const SZL = 'SZL';
    const THB = 'THB';
    const TJS = 'TJS';
    const TMT = 'TMT';
    const TND = 'TND';
    const TOP = 'TOP';
    const TRY_ = 'TRY'; // "try" is a PHP reserved word
    const TTD = 'TTD';
    const TWD = 'TWD';
    const TZS = 'TZS';
    const UAH = 'UAH';
    const UGX = 'UGX';
    const USD = 'USD';
    const UYU = 'UYU';
    const UZS = 'UZS';
    const VEF = 'VEF';
    const VND = 'VND';
    const VUV = 'VUV';
    const WST = 'WST';
    const XAF = 'XAF';
    const XCD = 'XCD';
    const XDR = 'XDR';
    const XOF = 'XOF';
    const XPF = 'XPF';
    const YER = 'YER';
    const ZAR = 'ZAR';
    const ZMK = 'ZMK';
    const ZWL = 'ZWL';
}
