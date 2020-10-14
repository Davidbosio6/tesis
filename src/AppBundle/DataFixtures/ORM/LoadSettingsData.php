<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Settings;
use AppBundle\Repository\SettingsRepository;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Persistence\ObjectManager;


class LoadSettingsData extends AbstractFixture
{
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
