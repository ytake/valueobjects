<?php

namespace ValueObjects\Tests\Structure;

use ValueObjects\Number\Integer;
use ValueObjects\Number\Natural;
use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Structure\Collection;
use ValueObjects\Tests\TestCase;

class CollectionTest extends TestCase
{
    /** @var Collection */
    protected $collection;

    public function setup()
    {
        $array = new \SplFixedArray(3);
        $array->offsetSet(0, new StringLiteral('one'));
        $array->offsetSet(1, new StringLiteral('two'));
        $array->offsetSet(2, new Integer(3));

        $this->collection = new Collection($array);
    }

    /** @expectedException \InvalidArgumentException */
    public function testInvalidArgument()
    {
        $array = \SplFixedArray::fromArray(array('one', 'two', 'three'));

        new Collection($array);
    }

    public function testFromNative()
    {
        $array = \SplFixedArray::fromArray(array(
            'one',
            'two',
            array(1, 2)
        ));
        $fromNativeCollection = Collection::fromNative($array);

        $innerArray = new Collection(
            \SplFixedArray::fromArray(array(
                    new StringLiteral('1'),
                    new StringLiteral('2')
            ))
        );
        $array = \SplFixedArray::fromArray(array(
            new StringLiteral('one'),
            new StringLiteral('two'),
            $innerArray
        ));
        $constructedCollection = new Collection($array);

        $this->assertTrue($fromNativeCollection->sameValueAs($constructedCollection));
    }

    public function testSameValueAs()
    {
        $array = \SplFixedArray::fromArray(array(
            new StringLiteral('one'),
            new StringLiteral('two'),
            new Integer(3)
        ));
        $collection2 = new Collection($array);

        $array = \SplFixedArray::fromArray(array(
            'one',
            'two',
            array(1, 2)
        ));
        $collection3 = Collection::fromNative($array);

        $this->assertTrue($this->collection->sameValueAs($collection2));
        $this->assertTrue($collection2->sameValueAs($this->collection));
        $this->assertFalse($this->collection->sameValueAs($collection3));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($this->collection->sameValueAs($mock));
    }

    public function testCount()
    {
        $three = new Natural(3);

        $this->assertTrue($this->collection->count()->sameValueAs($three));
    }

    public function testContains()
    {
        $one = new StringLiteral('one');
        $ten = new StringLiteral('ten');

        $this->assertTrue($this->collection->contains($one));
        $this->assertFalse($this->collection->contains($ten));
    }

    public function testToArray()
    {
        $array = array(
            new StringLiteral('one'),
            new StringLiteral('two'),
            new Integer(3)
        );

        $this->assertEquals($array, $this->collection->toArray());
    }

    public function testToString()
    {
        $this->assertEquals('ValueObjects\Structure\Collection(3)', $this->collection->__toString());
    }
}
