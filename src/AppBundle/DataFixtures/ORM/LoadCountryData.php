<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Country;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class LoadCountryData.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class LoadCountryData extends AbstractFixture implements FixtureInterface
{
    const ARGENTINA = 'c_argentina';

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $country = new Country();
        $country->setName('Argentina');
        $manager->persist($country);
        $this->addReference(self::ARGENTINA, $country);

        $manager->flush();
    }
}
