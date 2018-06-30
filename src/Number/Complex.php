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

namespace ValueObjects\Number;

use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

/**
 * Class Complex.
 */
class Complex implements ValueObjectInterface, NumberInterface
{
    /** @var float */
    protected $real;

    /** @var float */
    protected $im;

    /**
     * Returns a Complex object give its real and imaginary parts as parameters.
     *
     * @param float $real
     * @param float $im
     */
    public function __construct(Real $real, Real $im)
    {
        $this->real = $real;
        $this->im = $im;
    }

    /**
     * Returns a native string version of the Complex object in format "${real} +|- ${complex}i".
     *
     * @return string
     */
    public function __toString(): string
    {
        $format = '%g %+gi';
        $real = $this->getReal()->toNative();
        $im = $this->getIm()->toNative();
        $string = \sprintf($format, $real, $im);

        return \preg_replace('/(\+|-)/', '$1 ', $string);
    }

    /**
     * Returns a new Complex object from native PHP arguments.
     *
     * @param ...float $real Real part of the complex number
     * @param ...float $im   Imaginary part of the complex number
     *
     * @throws \BadMethodCallException
     *
     * @return Complex|ValueObjectInterface
     */
    public static function fromNative(): ValueObjectInterface
    {
        $args = \func_get_args();

        if (2 != \count($args)) {
            throw new \BadMethodCallException('You must provide 2 arguments: 1) real part, 2) imaginary part');
        }
        $complex = new static(
            Real::fromNative($args[0]),
            Real::fromNative($args[1])
        );

        return $complex;
    }

    /**
     * Returns a Complex given polar coordinates.
     *
     * @param float $modulus
     * @param float $argument
     *
     * @return Complex
     */
    public static function fromPolar(Real $modulus, Real $argument)
    {
        $realValue = $modulus->toNative() * \cos($argument->toNative());
        $imValue = $modulus->toNative() * \sin($argument->toNative());
        $complex = new static(new Real($realValue), new Real($imValue));

        return $complex;
    }

    /**
     * @param ValueObjectInterface $complex
     *
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $complex): bool
    {
        if (false === Util::classEquals($this, $complex)) {
            return false;
        }

        return $this->getReal()->sameValueAs($complex->getReal()) &&
            $this->getIm()->sameValueAs($complex->getIm());
    }

    /**
     * Returns the native value of the real and imaginary parts as an array.
     *
     * @return array
     */
    public function toNative(): array
    {
        return [
            $this->getReal()->toNative(),
            $this->getIm()->toNative(),
        ];
    }

    /**
     * Returns the real part of the complex number.
     *
     * @return float
     */
    public function getReal(): Real
    {
        return clone $this->real;
    }

    /**
     * Returns the imaginary part of the complex number.
     *
     * @return float
     */
    public function getIm(): Real
    {
        return clone $this->im;
    }

    /**
     * Returns the modulus (or absolute value or magnitude) of the Complex number.
     *
     * @return float
     */
    public function getModulus(): Real
    {
        $real = $this->getReal()->toNative();
        $im = $this->getIm()->toNative();
        $mod = \sqrt(\pow($real, 2) + \pow($im, 2));

        return new Real($mod);
    }

    /**
     * Returns the argument (or phase) of the Complex number.
     *
     * @return float
     */
    public function getArgument(): Real
    {
        $real = $this->getReal()->toNative();
        $im = $this->getIm()->toNative();
        $arg = \atan2($im, $real);

        return new Real($arg);
    }
}
