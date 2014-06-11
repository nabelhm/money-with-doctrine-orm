<?php

namespace Cubalider\Test\Component\Money\Manager;

use Cubalider\Component\Money\Manager\CurrencyManager;
use Cubalider\Component\Money\Entity\Currency;
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
        $currencyClass = 'Cubalider\Component\Money\Entity\Currency';

        $builder = new EntityManagerBuilder();
        $this->em = $builder->createEntityManager(
            array(
                $currencyClass,
            ),
            array(),
            array(
                'Cubalider\Component\Money\Entity\CurrencyInterface' => $currencyClass,
            )
        );
    }

    /**
     * @covers \Cubalider\Component\Money\Manager\CurrencyManager::__construct
     */
    public function testConstructor()
    {
        $class = 'Cubalider\Component\Money\Entity\Currency';
        $metadata = $this->getMock('Doctrine\Common\Persistence\Mapping\ClassMetadata');
        $metadata->expects($this->once())->method('getName')->will($this->returnValue($class));
        $em = $this->getMock('Doctrine\ORM\EntityManagerInterface');
        $em->expects($this->once())->method('getClassMetadata')->with($class)->will($this->returnValue($metadata));
        /** @var \Doctrine\ORM\EntityManagerInterface $em */
        $manager = new CurrencyManager($em, $class);

        $this->assertAttributeEquals($em, 'em', $manager);
        $this->assertAttributeEquals($class, 'class', $manager);
        $this->assertAttributeEquals($em->getRepository($class), 'repository', $manager);
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

        $class = 'Cubalider\Component\Money\Entity\Currency';

        $manager = new CurrencyManager($this->em, $class);
        $this->assertEquals($currency2, $manager->pick('bar'));

        $manager = new CurrencyManager($this->em, $class);
        $this->assertEquals($currency2, $manager->pick(array('code' => 'bar')));
    }
}