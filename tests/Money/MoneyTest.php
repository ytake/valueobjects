<?php

namespace ValueObjects\Tests\Money;

use ValueObjects\Number\Real;
use ValueObjects\Tests\TestCase;
use ValueObjects\Money\Money;
use ValueObjects\Money\Currency;
use ValueObjects\Money\CurrencyCode;
use ValueObjects\Number\Integer;

class MoneyTest extends TestCase
{
    public function testFromNative()
    {
        $fromNativeMoney  = Money::fromNative(2100, 'EUR');
        $constructedMoney = new Money(new Integer(2100), new Currency(CurrencyCode::EUR()));

        $this->assertTrue($fromNativeMoney->sameValueAs($constructedMoney));
    }

    public function testSameValueAs()
    {
        $eur = new Currency(CurrencyCode::EUR());
        $usd = new Currency(CurrencyCode::USD());

        $money1 = new Money(new Integer(1200), $eur);
        $money2 = new Money(new Integer(1200), $eur);
        $money3 = new Money(new Integer(34607), $usd);

        $this->assertTrue($money1->sameValueAs($money2));
        $this->assertTrue($money2->sameValueAs($money1));
        $this->assertFalse($money1->sameValueAs($money3));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($money1->sameValueAs($mock));
    }

    public function testGetAmount()
    {
        $eur    = new Currency(CurrencyCode::EUR());
        $money  = new Money(new Integer(1200), $eur);
        $amount = $money->getAmount();

        $this->assertInstanceOf('\ValueObjects\Number\Integer', $amount);
        $this->assertSame(1200, $amount->toNative());
    }

    public function testGetCurrency()
    {
        $eur      = new Currency(CurrencyCode::EUR());
        $money    = new Money(new Integer(1200), $eur);
        $currency = $money->getCurrency();

        $this->assertInstanceOf('\ValueObjects\Money\Currency', $currency);
        $this->assertSame('EUR', $currency->getCode()->toNative());
    }

    public function testAdd()
    {
        $eur      = new Currency(CurrencyCode::EUR());
        $money    = new Money(new Integer(1200), $eur);
        $addendum = new Integer(156);

        $addedMoney = $money->add($addendum);

        $this->assertEquals(1356, $addedMoney->getAmount()->toNative());
    }

    public function testAddNegative()
    {
        $eur      = new Currency(CurrencyCode::EUR());
        $money    = new Money(new Integer(1200), $eur);
        $addendum = new Integer(-120);

        $addedMoney = $money->add($addendum);

        $this->assertEquals(1080, $addedMoney->getAmount()->toNative());
    }

    public function testMultiply()
    {
        $eur        = new Currency(CurrencyCode::EUR());
        $money      = new Money(new Integer(1200), $eur);
        $multiplier = new Real(1.2);

        $addedMoney = $money->multiply($multiplier);

        $this->assertEquals(1440, $addedMoney->getAmount()->toNative());
    }

    public function testMultiplyInverse()
    {
        $eur        = new Currency(CurrencyCode::EUR());
        $money      = new Money(new Integer(1200), $eur);
        $multiplier = new Real(0.3);

        $addedMoney = $money->multiply($multiplier);

        $this->assertEquals(360, $addedMoney->getAmount()->toNative());
    }

    public function testToString()
    {
        $eur  = new Currency(CurrencyCode::EUR());
        $money = new Money(new Integer(1200), $eur);

        $this->assertSame('EUR 1200', $money->__toString());
    }
}
