<?php

namespace ValueObjects\Tests\Geography;

use ValueObjects\Geography\Address;
use ValueObjects\Geography\Country;
use ValueObjects\Geography\CountryCode;
use ValueObjects\Geography\Street;
use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Tests\TestCase;

class AddressTest extends TestCase
{
    /** @var Address */
    protected $address;

    public function setup()
    {
        $this->address = new Address(
            new StringLiteral('Nicolò Pignatelli'),
            new Street(new StringLiteral('via Manara'), new StringLiteral('3')),
            new StringLiteral(''),
            new StringLiteral('Altamura'),
            new StringLiteral('BARI'),
            new StringLiteral('70022'),
            new Country(CountryCode::IT())
        );
    }

    public function testFromNative()
    {
        $fromNativeAddress = Address::fromNative('Nicolò Pignatelli', 'via Manara', '3', '', 'Altamura', 'BARI', '70022', 'IT');
        $this->assertTrue($this->address->sameValueAs($fromNativeAddress));
    }

    /** @expectedException \BadMethodCallException */
    public function testInvalidFromNative()
    {
        Address::fromNative('invalid');
    }

    public function testSameValueAs()
    {
        $address2 = new Address(
            new StringLiteral('Nicolò Pignatelli'),
            new Street(new StringLiteral('via Manara'), new StringLiteral('3')),
            new StringLiteral(''),
            new StringLiteral('Altamura'),
            new StringLiteral('BARI'),
            new StringLiteral('70022'),
            new Country(CountryCode::IT())
        );

        $address3 = new Address(
            new StringLiteral('Nicolò Pignatelli'),
            new Street(new StringLiteral('SP159'), new StringLiteral('km 4')),
            new StringLiteral(''),
            new StringLiteral('Altamura'),
            new StringLiteral('BARI'),
            new StringLiteral('70022'),
            new Country(CountryCode::IT())
        );

        $this->assertTrue($this->address->sameValueAs($address2));
        $this->assertTrue($address2->sameValueAs($this->address));
        $this->assertFalse($this->address->sameValueAs($address3));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($this->address->sameValueAs($mock));
    }

    public function testGetName()
    {
        $name = new StringLiteral('Nicolò Pignatelli');
        $this->assertTrue($this->address->getName()->sameValueAs($name));
    }

    public function testGetStreet()
    {
        $street = new Street(new StringLiteral('via Manara'), new StringLiteral('3'));
        $this->assertTrue($this->address->getStreet()->sameValueAs($street));
    }

    public function testGetDistrict()
    {
        $district = new StringLiteral('');
        $this->assertTrue($this->address->getDistrict()->sameValueAs($district));
    }

    public function testGetCity()
    {
        $city = new StringLiteral('Altamura');
        $this->assertTrue($this->address->getCity()->sameValueAs($city));
    }

    public function testGetRegion()
    {
        $region = new StringLiteral('BARI');
        $this->assertTrue($this->address->getRegion()->sameValueAs($region));
    }

    public function testGetPostalCode()
    {
        $code = new StringLiteral('70022');
        $this->assertTrue($this->address->getPostalCode()->sameValueAs($code));
    }

    public function testGetCountry()
    {
        $country = new Country(CountryCode::IT());
        $this->assertTrue($this->address->getCountry()->sameValueAs($country));
    }

    public function testToString()
    {
        $addressString = <<<ADDR
Nicolò Pignatelli
3 via Manara
Altamura BARI 70022
Italy
ADDR;

        $this->assertSame($addressString, $this->address->__toString());
    }
}
