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
        $settings->setDescription('Dato utilizado en la vista invitado');
        $settings->setCode(SettingsRepository::SITE_NAME_CODE);
        $manager->persist($settings);

        $settings = new Settings();
        $settings->setName('Ubicación de contacto');
        $settings->setValue('Mitre 56, Coronel Moldes - Cordoba');
        $settings->setDescription('Dato utilizado en el apartado de Contacto');
        $settings->setCode(SettingsRepository::CONTACT_LOCATION_CODE);
        $manager->persist($settings);

        $settings = new Settings();
        $settings->setName('Teléfono de contacto');
        $settings->setValue('(3582) 456-7890');
        $settings->setDescription('Dato utilizado en el apartado de Contacto');
        $settings->setCode(SettingsRepository::CONTACT_PHONE_CODE);
        $manager->persist($settings);

        $settings = new Settings();
        $settings->setName('Correo electrónico de contacto');
        $settings->setValue('administracion@semilltas.com');
        $settings->setDescription('Dato utilizado en el apartado de Contacto');
        $settings->setCode(SettingsRepository::CONTACT_EMAIL_CODE);
        $manager->persist($settings);

        $settings = new Settings();
        $settings->setName('Dias de contacto');
        $settings->setValue('Lunes a Viernes');
        $settings->setDescription('Dato utilizado en el apartado de Contacto');
        $settings->setCode(SettingsRepository::CONTACT_SCHEDULE_DAYS_CODE);
        $manager->persist($settings);

        $settings = new Settings();
        $settings->setName('Horarios de contacto');
        $settings->setValue('8:00 - 12:00 | 13:00 - 17:00');
        $settings->setDescription('Dato utilizado en el apartado de Contacto');
        $settings->setCode(SettingsRepository::CONTACT_SCHEDULE_HOURS_CODE);
        $manager->persist($settings);

        $settings = new Settings();
        $settings->setName('Fin de clases');
        $settings->setValue('22-11-2021');
        $settings->setDescription('Dato utilizado para la creación de cronogramas. Formato dd-mm-yyyy');
        $settings->setCode(SettingsRepository::CALENDAR_LAST_DAY_CODE);
        $manager->persist($settings);

        $settings = new Settings();
        $settings->setName('Inicio de clases');
        $settings->setValue('01-03-2021');
        $settings->setDescription('Dato utilizado para la creación de cronogramas. Formato dd-mm-yyyy');
        $settings->setCode(SettingsRepository::CALENDAR_INIT_DAY_CODE);
        $manager->persist($settings);

        $manager->flush();
    }
}
