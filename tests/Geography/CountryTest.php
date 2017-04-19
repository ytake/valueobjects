<?php

namespace ValueObjects\Tests\Geography;

use ValueObjects\Geography\Country;
use ValueObjects\Geography\CountryCode;
use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Tests\TestCase;

class CountryTest extends TestCase
{
    public function testFromNative()
    {
        $fromNativeCountry  = Country::fromNative('IT');
        $constructedCountry = new Country(CountryCode::IT());

        $this->assertTrue($constructedCountry->sameValueAs($fromNativeCountry));
    }

    public function testSameValueAs()
    {
        $country1 = new Country(CountryCode::IT());
        $country2 = new Country(CountryCode::IT());
        $country3 = new Country(CountryCode::US());

        $this->assertTrue($country1->sameValueAs($country2));
        $this->assertFalse($country1->sameValueAs($country3));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($country1->sameValueAs($mock));
    }

    public function testGetCode()
    {
        $italy = new Country(CountryCode::IT());
        $this->assertTrue($italy->getCode()->sameValueAs(CountryCode::IT()));
    }

    public function testGetName()
    {
        $italy = new Country(CountryCode::IT());
        $name  = new StringLiteral('Italy');
        $this->assertTrue($italy->getName()->sameValueAs($name));
    }

    public function testToString()
    {
        $italy = new Country(CountryCode::IT());
        $this->assertSame('Italy', $italy->__toString());
    }
}
