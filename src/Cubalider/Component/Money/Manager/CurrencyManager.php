<?php

namespace Cubalider\Component\Money\Manager;

use Doctrine\ORM\EntityManagerInterface;
use Yosmanyga\Component\Dql\Fit\Builder;
use Yosmanyga\Component\Dql\Fit\WhereCriteriaFit;

/**
 * @author Yosmany Garcia <yosmanyga@gmail.com>
 */
class CurrencyManager implements CurrencyManagerInterface
{
    /**
     * @var string
     */
    private $class = 'Cubalider\Component\Money\Model\Currency';

    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $em;

    /**
     * @var Builder;
     */
    private $builder;

    /**
     * Constructor.
     *
     * @param EntityManagerInterface $em
     * @param Builder       $builder
     */
    public function __construct(EntityManagerInterface $em, Builder $builder = null)
    {
        $this->em = $em;
        $this->builder = $builder ?: new Builder($em);
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

        $qb = $this->builder->build(
            $this->class,
            new WhereCriteriaFit($criteria)
        );

        return $qb
            ->getQuery()
            ->getOneOrNullResult();
    }
}
