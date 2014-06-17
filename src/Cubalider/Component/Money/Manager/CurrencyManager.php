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
     * Constructor.
     * Additionally it creates a repository using $em, for given class.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository('Cubalider\Component\Money\Model\Currency');
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