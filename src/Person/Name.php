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

namespace ValueObjects\Person;

use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

/**
 * Class Name.
 */
class Name implements ValueObjectInterface
{
    /**
     * First name.
     *
     * @var \ValueObjects\StringLiteral\StringLiteral
     */
    private $firstName;

    /**
     * Middle name.
     *
     * @var \ValueObjects\StringLiteral\StringLiteral
     */
    private $middleName;

    /**
     * Last name.
     *
     * @var \ValueObjects\StringLiteral\StringLiteral
     */
    private $lastName;

    /**
     * Returns a Name object.
     *
     * @param StringLiteral $firstName
     * @param StringLiteral $middleName
     * @param StringLiteral $lastName
     */
    public function __construct(
        StringLiteral $firstName,
        StringLiteral $middleName,
        StringLiteral $lastName
    ) {
        $this->firstName = $firstName;
        $this->middleName = $middleName;
        $this->lastName = $lastName;
    }

    /**
     * Returns the full name.
     *
     * @return string
     */
    public function __toString(): string
    {
        return \strval($this->getFullName());
    }

    /**
     * Returns a Name objects form PHP native values.
     *
     * @param string $first_name
     * @param string $middle_name
     * @param string $last_name
     *
     * @return Name|ValueObjectInterface
     */
    public static function fromNative(): ValueObjectInterface
    {
        $args = func_get_args();

        $firstName = new StringLiteral($args[0]);
        $middleName = new StringLiteral($args[1]);
        $lastName = new StringLiteral($args[2]);

        return new static($firstName, $middleName, $lastName);
    }

    /**
     * Returns the first name.
     *
     * @return StringLiteral
     */
    public function getFirstName(): StringLiteral
    {
        return $this->firstName;
    }

    /**
     * Returns the middle name.
     *
     * @return StringLiteral
     */
    public function getMiddleName(): StringLiteral
    {
        return $this->middleName;
    }

    /**
     * Returns the last name.
     *
     * @return StringLiteral
     */
    public function getLastName(): StringLiteral
    {
        return $this->lastName;
    }

    /**
     * Returns the full name.
     *
     * @return StringLiteral
     */
    public function getFullName(): StringLiteral
    {
        $fullNameString = $this->firstName.
            ($this->middleName->isEmpty() ? '' : ' '.$this->middleName).
            ($this->lastName->isEmpty() ? '' : ' '.$this->lastName);

        $fullName = new StringLiteral($fullNameString);

        return $fullName;
    }

    /**
     * Tells whether two names are equal by comparing their values.
     *
     * @param Name|ValueObjectInterface $name
     *
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $name): bool
    {
        if (false === Util::classEquals($this, $name)) {
            return false;
        }

        return \strval($this->getFullName()) === \strval($name->getFullName());
    }
}
