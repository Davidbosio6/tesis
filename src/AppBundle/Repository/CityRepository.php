<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * CityRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CityRepository extends EntityRepository
{
    /**
     * @return Query
     */
    public function findAllQuery()
    {
        $qb = $this->createQueryBuilder('city');

        return $qb->getQuery();
    }

    /**
     * @param string $filter
     *
     * @return Query
     */
    public function findAllByFilter(string $filter)
    {
        $qb = $this->createQueryBuilder('city')
            ->join('city.province', 'province')
            ->join('province.country', 'country');

        return $qb->where(
            $qb->expr()->orX(
                $qb->expr()->like('city.id', ':value'),
                $qb->expr()->like('city.name', ':value'),
                $qb->expr()->like('city.postalCode', ':value'),
                $qb->expr()->like('province.name', ':value'),
                $qb->expr()->like('country.name', ':value'),
            )
        )
            ->setParameter('value', "%" . trim($filter) . "%")
            ->getQuery();
    }
}
