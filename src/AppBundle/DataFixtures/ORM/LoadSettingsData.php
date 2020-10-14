<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\City;
use AppBundle\Entity\Province;
use AppBundle\Entity\Settings;
use AppBundle\Repository\SettingsRepository;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class LoadSettingsData extends AbstractFixture
{
    const SAMPACHO = 'c_sampacho';

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $settings = new Settings();
        $settings->setName('Nombre del sitio');
        $settings->setValue('Semillitas de amor');
        $settings->setCode(SettingsRepository::SITE_NAME_CODE);
        $manager->persist($settings);

        $manager->flush();
    }
}
