<?hh // strict

namespace ValueObjects\Web;

use ValueObjects\Structure\Dictionary;

interface QueryStringInterface
{
    public function toDictionary(): Dictionary;
}
