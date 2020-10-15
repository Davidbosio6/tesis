<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Country;
use AppBundle\Entity\Province;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class LoadProvinceData extends AbstractFixture implements DependentFixtureInterface
{
    const CORDOBA = 'p_cordoba';

    const SAN_LUIS = 'p_villa_mercedes';

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        /** @var Country $country */
        $country = $this->getReference(LoadCountryData::ARGENTINA);

        $province = new Province();
        $province->setName('Buenos Aires');
        $province->setCountry($country);
        $manager->persist($province);

        $province = new Province();
        $province->setName('Catamarca');
        $province->setCountry($country);
        $manager->persist($province);

        $province = new Province();
        $province->setName('Chaco');
        $province->setCountry($country);
        $manager->persist($province);

        $province = new Province();
        $province->setName('Chubut');
        $province->setCountry($country);
        $manager->persist($province);

        $province = new Province();
        $province->setName('Córdoba');
        $province->setCountry($country);
        $manager->persist($province);
        $this->addReference(self::CORDOBA, $province);

        $province = new Province();
        $province->setName('Corrientes');
        $province->setCountry($country);
        $manager->persist($province);

        $province = new Province();
        $province->setName('Entre Ríos');
        $province->setCountry($country);
        $manager->persist($province);

        $province = new Province();
        $province->setName('Formosa');
        $province->setCountry($country);
        $manager->persist($province);

        $province = new Province();
        $province->setName('Jujuy');
        $province->setCountry($country);
        $manager->persist($province);

        $province = new Province();
        $province->setName('La Pampa');
        $province->setCountry($country);
        $manager->persist($province);

        $province = new Province();
        $province->setName('La Rioja');
        $province->setCountry($country);
        $manager->persist($province);

        $province = new Province();
        $province->setName('Mendoza');
        $province->setCountry($country);
        $manager->persist($province);

        $province = new Province();
        $province->setName('Misiones');
        $province->setCountry($country);
        $manager->persist($province);

        $province = new Province();
        $province->setName('Neuquén');
        $province->setCountry($country);
        $manager->persist($province);

        $province = new Province();
        $province->setName('Río Negro');
        $province->setCountry($country);
        $manager->persist($province);

        $province = new Province();
        $province->setName('Salta');
        $province->setCountry($country);
        $manager->persist($province);

        $province = new Province();
        $province->setName('San Juan');
        $province->setCountry($country);
        $manager->persist($province);

        $province = new Province();
        $province->setName('San Luis');
        $province->setCountry($country);
        $manager->persist($province);
        $this->addReference(self::SAN_LUIS, $province);

        $province = new Province();
        $province->setName('Santa Cruz');
        $province->setCountry($country);
        $manager->persist($province);

        $province = new Province();
        $province->setName('Santa Fe');
        $province->setCountry($country);
        $manager->persist($province);

        $province = new Province();
        $province->setName('Santiago del Estero');
        $province->setCountry($country);
        $manager->persist($province);

        $province = new Province();
        $province->setName('Tierra del Fuego');
        $province->setCountry($country);
        $manager->persist($province);

        $province = new Province();
        $province->setName('Tucumán');
        $province->setCountry($country);
        $manager->persist($province);

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            LoadCountryData::class,
        ];
    }
}
