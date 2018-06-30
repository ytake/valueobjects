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

namespace ValueObjects\Climate;

/**
 * Class Kelvin.
 */
class Kelvin extends Temperature
{
    /**
     * @return Celsius
     */
    public function toCelsius(): Celsius
    {
        return new Celsius($this->value - 273.15);
    }

    /**
     * @return Kelvin
     */
    public function toKelvin(): Kelvin
    {
        return new static($this->value);
    }

    /**
     * @return Fahrenheit
     */
    public function toFahrenheit(): Fahrenheit
    {
        return new Fahrenheit($this->toCelsius()->toNative() * 1.8 + 32);
    }
}
