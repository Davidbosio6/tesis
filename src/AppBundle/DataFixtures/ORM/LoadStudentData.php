<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Advisor;
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

        /** @var Advisor $advisor1 */
        $advisor1 = $this->getReference(LoadAdvisorData::ADVISOR_1);
        /** @var Advisor $advisor2 */
        $advisor2 = $this->getReference(LoadAdvisorData::ADVISOR_2);
        /** @var Advisor $advisor3 */
        $advisor3 = $this->getReference(LoadAdvisorData::ADVISOR_3);
        /** @var Advisor $advisor4 */
        $advisor4 = $this->getReference(LoadAdvisorData::ADVISOR_4);

        $student = new Student();
        $student->setIdNumber(86201589);
        $student->setBirthdate(new DateTime('now -3 years'));
        $student->setAddress('Mendoza 32');
        $student->setFirstName('Lorena');
        $student->setLastName('Diaz');
        $student->setCity($city);
        $student->addAdvisor($advisor1);
        $student->addAdvisor($advisor2);
        $manager->persist($student);

        $student = new Student();
        $student->setIdNumber(86201589);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Maipú 1209');
        $student->setFirstName('Ramiro');
        $student->setLastName('Fernandez');
        $student->setCity($city);
        $student->addAdvisor($advisor3);
        $student->addAdvisor($advisor4);
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
            LoadTeacherData::class
        ];
    }
}
