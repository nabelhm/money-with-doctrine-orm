<?php

namespace Cubalider\Component\Money\Manager;

use Doctrine\ORM\EntityManagerInterface;

/**
 * @author Yosmany Garcia <yosmanyga@gmail.com>
 */
class CurrencyManager implements CurrencyManagerInterface
{
    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $em;

    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    private $repository;

    /**
     * Constructor
     *
     * Additionally it creates a repository using $em, for given class
     *
     * @param EntityManagerInterface $em
     * @param string $class
     */
    public function __construct(
        EntityManagerInterface $em,
        $class = 'Cubalider\Component\Money\Model\Currency'
    )
    {
        $this->em = $em;
        $this->class = $em->getClassMetadata($class)->getName();
        $this->repository = $this->em->getRepository($class);
    }

    /**
     * Picks a currency using given criteria
     *
     * @param string|array $criteria
     * @return mixed
     */
    public function pick($criteria)
    {
        if (is_string($criteria)) {
            $criteria = array('code' => $criteria);
        }

        return $this->repository->findOneBy($criteria);
    }
}