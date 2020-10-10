<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Shift;
use DateTime;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;


class LoadShiftData extends AbstractFixture implements FixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $shift = new Shift();
        $shift->setName('Turno Mañana');
        $shift->setStartHour(new DateTime('08:00:00'));
        $shift->setEndHour(new DateTime('12:30:00'));
        $manager->persist($shift);

        $shift = new Shift();
        $shift->setName('Turno Tarde');
        $shift->setStartHour(new DateTime('13:00:00'));
        $shift->setEndHour(new DateTime('18:30:00'));
        $manager->persist($shift);

        $manager->flush();
    }
}
