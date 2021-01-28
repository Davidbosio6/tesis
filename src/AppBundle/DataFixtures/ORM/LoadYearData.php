<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Year;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class LoadYearData.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class LoadYearData extends AbstractFixture implements FixtureInterface
{
    const YEAR_2021 = 'y_2021';

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $year = new Year();
        $year->setName('2020');
        $manager->persist($year);

        $year = new Year();
        $year->setName('2021');
        $manager->persist($year);
        $this->addReference(self::YEAR_2021, $year);

        $manager->flush();
    }
}
