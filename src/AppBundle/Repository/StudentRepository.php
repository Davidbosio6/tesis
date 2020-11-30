<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Student;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * StudentRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class StudentRepository extends EntityRepository
{
    /**
     * @return Query
     */
    public function findAllQuery()
    {
        $qb = $this->createQueryBuilder('student');

        return $qb->getQuery();
    }

    /**
     * @param string $filter
     *
     * @return Query
     */
    public function findAllByFilter(string $filter)
    {
        $qb = $this->createQueryBuilder('student')
            ->join('student.classroom', 'classroom')
            ->join('student.plan', 'plan')
            ->join('classroom.shift', 'shift');

        return $qb->where(
            $qb->expr()->orX(
                $qb->expr()->like('student.id', ':value'),
                $qb->expr()->like('student.firstName', ':value'),
                $qb->expr()->like('student.lastName', ':value'),
                $qb->expr()->like('student.idNumber', ':value'),
                $qb->expr()->like('shift.name', ':value'),
                $qb->expr()->like('plan.name', ':value')
            )
        )
            ->setParameter('value', "%" . trim($filter) . "%")
            ->getQuery();
    }

    /**
     * @param string $value
     *
     * @return Student[]|null
     */
    public function findAllBySex(string $value)
    {
        $qb = $this->createQueryBuilder('student');

        return $qb->where(
            $qb->expr()->like('student.sex', ':value')
        )
            ->setParameter('value', $value)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param string $value
     *
     * @return Student[]|null
     */
    public function findAllByInstallmentsGenerated(string $value)
    {
        $qb = $this->createQueryBuilder('student');

        return $qb->where(
            $qb->expr()->eq('student.installmentsGenerated', ':value')
        )
            ->setParameter('value', $value)
            ->getQuery()
            ->getResult();
    }
}
