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

use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

class Street implements ValueObjectInterface
{
    /** @var StringLiteral */
    protected $name;

    /** @var StringLiteral */
    protected $number;

    /** @var StringLiteral Building, floor and unit */
    protected $elements;

    /**
     * @var StringLiteral __toString() format
     *                    Use properties corresponding placeholders: %name%, %number%, %elements%
     */
    protected $format;

    /**
     * Returns a new Street object.
     *
     * @param StringLiteral      $name
     * @param StringLiteral      $number
     * @param StringLiteral|null $elements
     * @param StringLiteral|null $format
     */
    public function __construct(
        StringLiteral $name,
        StringLiteral $number,
        StringLiteral $elements = null,
        StringLiteral $format = null
    ) {
        $this->name = $name;
        $this->number = $number;

        if (null === $elements) {
            $elements = new StringLiteral('');
        }
        $this->elements = $elements;

        if (null === $format) {
            $format = new StringLiteral('%number% %name%');
        }
        $this->format = $format;
    }

    /**
     * Returns a string representation of the StringLiteral in the format defined in the constructor.
     *
     * @return string
     */
    public function __toString(): string
    {
        $replacements = [
            '%name%' => $this->getName(),
            '%number%' => $this->getNumber(),
            '%elements%' => $this->getElements(),
        ];

        $streetString = str_replace(array_keys($replacements), array_values($replacements), $this->format);

        return $streetString;
    }

    /**
     * Returns a new Street from native PHP string name and number.
     *
     * @param string $name
     * @param string $number
     * @param string $elements
     *
     * @throws \BadFunctionCallException
     *
     * @return Street|ValueObjectInterface
     */
    public static function fromNative(): ValueObjectInterface
    {
        $args = func_get_args();

        if (\count($args) < 2) {
            throw new \BadMethodCallException(
                'You must provide from 2 to 4 arguments: 1) street name, 2) street number, 3) elements, 4) format (optional)'
            );
        }

        $nameString = $args[0];
        $numberString = $args[1];
        $elementsString = isset($args[2]) ? $args[2] : '';
        $formatString = isset($args[3]) ? $args[3] : '';

        $name = new StringLiteral($nameString);
        $number = new StringLiteral($numberString);
        $elements = $elementsString ? new StringLiteral($elementsString) : null;
        $format = $formatString ? new StringLiteral($formatString) : null;

        return new static($name, $number, $elements, $format);
    }

    /**
     * Tells whether two Street objects are equal.
     *
     * @param Street|ValueObjectInterface $street
     *
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $street): bool
    {
        if (false === Util::classEquals($this, $street)) {
            return false;
        }

        return $this->getName()->sameValueAs($street->getName()) &&
            $this->getNumber()->sameValueAs($street->getNumber()) &&
            $this->getElements()->sameValueAs($street->getElements());
    }

    /**
     * Returns street name.
     *
     * @return StringLiteral
     */
    public function getName(): StringLiteral
    {
        return clone $this->name;
    }

    /**
     * Returns street number.
     *
     * @return StringLiteral
     */
    public function getNumber(): StringLiteral
    {
        return clone $this->number;
    }

    /**
     * Returns street elements.
     *
     * @return StringLiteral
     */
    public function getElements(): StringLiteral
    {
        return clone $this->elements;
    }
}
