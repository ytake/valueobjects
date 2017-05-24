<?hh // decl

/**
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 *
 * Copyright (c) 2017 Yuuki Takezawa
 */

namespace ValueObjects\StringLiteral;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

class StringLiteral implements ValueObjectInterface
{
    protected string $value;

    public static function fromNative(): StringLiteral;

    public function __construct($value);

    public function toNative(): string;

    public function sameValueAs(ValueObjectInterface $stringLiteral): bool;

    public function isEmpty(): bool;

    public function __toString(): string;
}
