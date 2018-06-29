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
 * Class Fahrenheit.
 */
class Fahrenheit extends Temperature
{
    /**
     * @return Celsius
     */
    public function toCelsius(): Celsius
    {
        return new Celsius(($this->value - 32) / 1.8);
    }

    /**
     * @return Kelvin
     */
    public function toKelvin(): Kelvin
    {
        return new Kelvin($this->toCelsius()->toNative() + 273.15);
    }

    /**
     * @return Fahrenheit
     */
    public function toFahrenheit(): Fahrenheit
    {
        return new static($this->value);
    }
}
