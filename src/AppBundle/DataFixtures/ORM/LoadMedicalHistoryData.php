<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\MedicalHistory;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;


class LoadMedicalHistoryData extends AbstractFixture implements FixtureInterface
{
    const MEDICAL_HISTORY_1 = "medical_history_1";
    const MEDICAL_HISTORY_2 = "medical_history_2";

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $medicalHistory = new MedicalHistory();
        $medicalHistory->setWeight('25 kg');
        $medicalHistory->setHeight('0.58 mts');
        $medicalHistory->setBloodType('A+');
        $medicalHistory->setAllergy(null);
        $medicalHistory->setChronicIllness(null);
        $medicalHistory->setMedicine(null);
        $medicalHistory->setAsma(1);
        $medicalHistory->setSinusitis(0);
        $medicalHistory->setBronquitis(0);
        $medicalHistory->setOtitis(0);
        $medicalHistory->setTosConvulsiva(0);
        $medicalHistory->setMigrania(1);
        $medicalHistory->setDiabetes(0);
        $medicalHistory->setCeliaco(0);
        $manager->persist($medicalHistory);
        $this->addReference(self::MEDICAL_HISTORY_1, $medicalHistory);

        $medicalHistory = new MedicalHistory();
        $medicalHistory->setWeight('28 kg');
        $medicalHistory->setHeight('0.62 mts');
        $medicalHistory->setBloodType('0+');
        $medicalHistory->setAllergy(null);
        $medicalHistory->setChronicIllness(null);
        $medicalHistory->setMedicine(null);
        $medicalHistory->setAsma(0);
        $medicalHistory->setSinusitis(0);
        $medicalHistory->setBronquitis(0);
        $medicalHistory->setOtitis(0);
        $medicalHistory->setTosConvulsiva(0);
        $medicalHistory->setMigrania(0);
        $medicalHistory->setDiabetes(0);
        $medicalHistory->setCeliaco(1);
        $manager->persist($medicalHistory);
        $this->addReference(self::MEDICAL_HISTORY_2, $medicalHistory);

        $manager->flush();
    }
}
