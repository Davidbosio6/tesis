<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Settings;
use AppBundle\Repository\SettingsRepository;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Class LoadSettingsData.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
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

        $settings = new Settings();
        $settings->setName('Ubicación de contacto');
        $settings->setValue('Mitre 56, Coronel Moldes - Cordoba');
        $settings->setCode(SettingsRepository::CONTACT_LOCATION_CODE);
        $manager->persist($settings);

        $settings = new Settings();
        $settings->setName('Teléfono de contacto');
        $settings->setValue('(3582) 456-7890');
        $settings->setCode(SettingsRepository::CONTACT_PHONE_CODE);
        $manager->persist($settings);

        $settings = new Settings();
        $settings->setName('Correo electrónico de contacto');
        $settings->setValue('administracion@semilltas.com');
        $settings->setCode(SettingsRepository::CONTACT_EMAIL_CODE);
        $manager->persist($settings);

        $settings = new Settings();
        $settings->setName('Dias de contacto');
        $settings->setValue('Lunes a Viernes');
        $settings->setCode(SettingsRepository::CONTACT_SCHEDULE_DAYS_CODE);
        $manager->persist($settings);

        $settings = new Settings();
        $settings->setName('Horarios de contacto');
        $settings->setValue('8:00 - 12:00 | 13:00 - 17:00');
        $settings->setCode(SettingsRepository::CONTACT_SCHEDULE_HOURS_CODE);
        $manager->persist($settings);

        $manager->flush();
    }
}
