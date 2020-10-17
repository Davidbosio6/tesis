<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\City;
use AppBundle\Entity\Student;
use DateTime;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class LoadStudentData extends AbstractFixture implements DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        /** @var City $city */
        $city = $this->getReference(LoadCityData::CNEL_MOLDES);

        $student = new Student();
        $student->setIdNumber(86201589);
        $student->setBirthdate(new DateTime('now -3 years'));
        $student->setAddress('9 de Julio 1120');
        $student->setFirstName('Lorena');
        $student->setLastName('Diaz');
        $student->setCity($city);
        $manager->persist($student);

        $student = new Student();
        $student->setIdNumber(86201589);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Dean Funes 680');
        $student->setFirstName('Ramiro');
        $student->setLastName('Fernandez');
        $student->setCity($city);
        $manager->persist($student);

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            LoadCityData::class,
        ];
    }
}
