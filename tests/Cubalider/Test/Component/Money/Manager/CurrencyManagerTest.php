<?php

namespace Cubalider\Test\Component\Money\Manager;

use Cubalider\Component\Money\Manager\CurrencyManager;
use Cubalider\Component\Money\Model\Currency;
use Doctrine\ORM\EntityManager;
use Cubalider\Test\Component\Money\EntityManagerBuilder;

/**
 * @author Yosmany Garcia <yosmanyga@gmail.com>
 */
class CurrencyManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EntityManager
     */
    private $em;

    protected function setUp()
    {
        $builder = new EntityManagerBuilder();
        $this->em = $builder->createEntityManager(
            array(
                sprintf("%s/../../../../../../src/Cubalider/Component/Money/Resources/config/doctrine", __DIR__)
            ),
            array(
                'Cubalider\Component\Money\Model\Currency',
            )
        );
    }

    /**
     * @covers \Cubalider\Component\Money\Manager\CurrencyManager::__construct
     */
    public function testConstructor()
    {
        $manager = new CurrencyManager($this->em);

        $this->assertAttributeEquals($this->em, 'em', $manager);
        $this->assertAttributeEquals($this->em->getRepository('Cubalider\Component\Money\Model\Currency'), 'repository', $manager);
    }

    /**
     * @covers \Cubalider\Component\Money\Manager\CurrencyManager::pick
     */
    public function testPick()
    {
        /* Fixtures */

        $currency1 = new Currency();
        $currency1->setCode('foo');
        $currency1->setName('Foo');
        $this->em->persist($currency1);
        $currency2 = new Currency();
        $currency2->setCode('bar');
        $currency2->setName('Bar');
        $this->em->persist($currency2);
        $this->em->flush();

        /* Tests */

        $manager = new CurrencyManager($this->em);
        $this->assertEquals($currency2, $manager->pick('bar'));

        $manager = new CurrencyManager($this->em);
        $this->assertEquals($currency2, $manager->pick(array('code' => 'bar')));
    }
}