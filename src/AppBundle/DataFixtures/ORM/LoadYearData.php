<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Year;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;


class LoadYearData extends AbstractFixture implements FixtureInterface
{
    const YEAR_2020 = 'y_2020';

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $year = new Year();
        $year->setName('2019');
        $manager->persist($year);

        $year = new Year();
        $year->setName('2020');
        $manager->persist($year);
        $this->addReference(self::YEAR_2020, $year);

        $manager->flush();
    }
}
