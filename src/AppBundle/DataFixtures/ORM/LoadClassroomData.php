<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Classroom;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;


class LoadClassroomData extends AbstractFixture implements FixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $shift = new Classroom();
        $shift->setName('Celeste');
        $shift->setNotes('Sala de 3');
        $shift->setCapacity(26);
        $manager->persist($shift);

        $shift = new Classroom();
        $shift->setName('Verde');
        $shift->setCapacity(30);
        $shift->setNotes('Sala de 4');
        $manager->persist($shift);

        $manager->flush();
    }
}
