<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * SubjectRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SubjectRepository extends EntityRepository
{
    /**
     * @return Query
     */
    public function findAllQuery()
    {
        $qb = $this->createQueryBuilder('subject');

        return $qb->getQuery();
    }
}