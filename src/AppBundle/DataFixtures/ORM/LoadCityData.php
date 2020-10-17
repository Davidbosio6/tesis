<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\City;
use AppBundle\Entity\Province;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class LoadCityData extends AbstractFixture implements DependentFixtureInterface
{
    const SAMPACHO = 'c_sampacho';

    const CNEL_MOLDES = 'c_cnel_moldes';

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        /** @var Province $cordobaProvince */
        $cordobaProvince = $this->getReference(LoadProvinceData::CORDOBA);
        /** @var Province $sanLuisProvince */
        $sanLuisProvince = $this->getReference(LoadProvinceData::SAN_LUIS);

        $city = new City();
        $city->setName('Coronel Moldes');
        $city->setPostalCode('5847');
        $city->setProvince($cordobaProvince);
        $manager->persist($city);
        $this->addReference(self::CNEL_MOLDES, $city);

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
        $this->addReference(self::SAMPACHO, $city);

        $city = new City();
        $city->setName('Las Vertientes');
        $city->setPostalCode('5839');
        $city->setProvince($cordobaProvince);
        $manager->persist($city);

        $city = new City();
        $city->setName('Merlo');
        $city->setPostalCode('5881');
        $city->setProvince($sanLuisProvince);
        $manager->persist($city);

        $city = new City();
        $city->setName('Santa Catalina (Holmberg)');
        $city->setPostalCode('5825');
        $city->setProvince($cordobaProvince);
        $manager->persist($city);

        $city = new City();
        $city->setName('Suco');
        $city->setPostalCode('5837');
        $city->setProvince($cordobaProvince);
        $manager->persist($city);

        $city = new City();
        $city->setName('Rio cuarto');
        $city->setPostalCode('5800');
        $city->setProvince($cordobaProvince);
        $manager->persist($city);

        $city = new City();
        $city->setName('Villa Mercedes');
        $city->setPostalCode('5730');
        $city->setProvince($sanLuisProvince);
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
