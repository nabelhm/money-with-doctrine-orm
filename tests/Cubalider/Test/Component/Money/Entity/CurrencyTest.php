<?php

namespace Cubalider\Test\Component\Money\Model;

use Cubalider\Component\Money\Entity\Currency;

/**
 * @author Yosmany Garcia <yosmanyga@gmail.com>
 */
class CurrencyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \Cubalider\Component\Money\Entity\Currency::getId
     */
    public function testId()
    {
        $inbox = new Currency();
        $this->assertNull($inbox->getId());
    }

    /**
     * @covers \Cubalider\Component\Money\Entity\Currency::setCode
     * @covers \Cubalider\Component\Money\Entity\Currency::getCode
     */
    public function testCode()
    {
        $currency = new Currency();
        $this->assertNull($currency->getCode());

        $code = 'USD';
        $currency->setCode($code);
        $this->assertEquals($code, $currency->getCode());
    }

    /**
     * @covers \Cubalider\Component\Money\Entity\Currency::setName
     * @covers \Cubalider\Component\Money\Entity\Currency::getName
     */
    public function testName()
    {
        $currency = new Currency();
        $this->assertNull($currency->getName());

        $name = 'Dollar';
        $currency->setName($name);
        $this->assertEquals($name, $currency->getName());
    }
}