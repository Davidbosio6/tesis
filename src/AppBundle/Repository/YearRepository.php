<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * YearRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class YearRepository extends EntityRepository
{
    /**
     * @return Query
     */
    public function findAllQuery()
    {
        $qb = $this->createQueryBuilder('year');

        return $qb->getQuery();
    }

    /**
     * @param string $filter
     *
     * @return Query
     */
    public function findAllByFilter(string $filter)
    {
        $qb = $this->createQueryBuilder('year');

        return $qb->where(
                $qb->expr()->like('year.name', ':value')
        )
            ->setParameter('value', "%" . trim($filter) . "%")
            ->getQuery();
    }
}
