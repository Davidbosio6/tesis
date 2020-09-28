<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\City;
use AppBundle\Entity\Province;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class LoadCityData extends AbstractFixture implements DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        /** @var Province $cordobaProvince */
        $cordobaProvince = $this->getReference(LoadProvinceData::CORDOBA);

        $city = new City();
        $city->setName('Coronel Moldes');
        $city->setPostalCode('5847');
        $city->setProvince($cordobaProvince);
        $manager->persist($city);

        $city = new City();
        $city->setName('Bulnes');
        $city->setPostalCode('5845');
        $city->setProvince($cordobaProvince);
        $manager->persist($city);

        $city = new City();
        $city->setName('Sampacho');
        $city->setPostalCode('5829');
        $city->setProvince($cordobaProvince);
        $manager->persist($city);

        $city = new City();
        $city->setName('Las Vertientes');
        $city->setPostalCode('5839');
        $city->setProvince($cordobaProvince);
        $manager->persist($city);

        $city = new City();
        $city->setName('Santa Catalina (Holmberg)');
        $city->setPostalCode('5825');
        $city->setProvince($cordobaProvince);
        $manager->persist($city);

        $city = new City();
        $city->setName('Rio cuarto');
        $city->setPostalCode('5800');
        $city->setProvince($cordobaProvince);
        $manager->persist($city);

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            LoadProvinceData::class,
        ];
    }
}
