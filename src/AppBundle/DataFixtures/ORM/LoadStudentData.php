<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\City;
use AppBundle\Entity\Classroom;
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

        /** @var Classroom $classroom1 */
        $classroom1 = $this->getReference(LoadClassroomData::CELESTE);
        /** @var Classroom $classroom2 */
        $classroom2 = $this->getReference(LoadClassroomData::VERDE);

        $student = new Student();
        $student->setIdNumber(86201589);
        $student->setBirthdate(new DateTime('now -3 years'));
        $student->setAddress('9 de Julio 1120');
        $student->setFirstName('Lorena');
        $student->setLastName('Diaz');
        $student->setCity($city);
        $student->setClassroom($classroom1);
        $manager->persist($student);

        $student = new Student();
        $student->setIdNumber(86201589);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Dean Funes 680');
        $student->setFirstName('Ramiro');
        $student->setLastName('Fernandez');
        $student->setCity($city);
        $student->setClassroom($classroom2);
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
            LoadClassroomData::class
        ];
    }
}
