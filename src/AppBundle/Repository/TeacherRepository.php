<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * TeacherRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TeacherRepository extends EntityRepository
{
    /**
     * @return Query
     */
    public function findAllQuery()
    {
        $qb = $this->createQueryBuilder('teacher');

        return $qb->getQuery();
    }
}
