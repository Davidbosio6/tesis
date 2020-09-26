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
        $city->setProvince($cordobaProvince);
        $manager->persist($city);

        $city = new City();
        $city->setName('Bulnes');
        $city->setProvince($cordobaProvince);
        $manager->persist($city);

        $city = new City();
        $city->setName('Sampacho');
        $city->setProvince($cordobaProvince);
        $manager->persist($city);

        $city = new City();
        $city->setName('Las Vertientes');
        $city->setProvince($cordobaProvince);
        $manager->persist($city);

        $city = new City();
        $city->setName('Santa Catalina (Holmberg)');
        $city->setProvince($cordobaProvince);
        $manager->persist($city);

        $city = new City();
        $city->setName('Rio cuarto');
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
