<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Advisor;
use AppBundle\Entity\City;
use AppBundle\Entity\Classroom;
use AppBundle\Entity\MedicalHistory;
use AppBundle\Entity\Plan;
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
        /** @var City $city1 */
        $city1 = $this->getReference(LoadCityData::CNEL_MOLDES);

        /** @var Advisor $advisor1 */
        $advisor1 = $this->getReference(LoadAdvisorData::ADVISOR_1);
        /** @var Advisor $advisor2 */
        $advisor2 = $this->getReference(LoadAdvisorData::ADVISOR_2);
        /** @var Advisor $advisor3 */
        $advisor3 = $this->getReference(LoadAdvisorData::ADVISOR_3);
        /** @var Advisor $advisor4 */
        $advisor4 = $this->getReference(LoadAdvisorData::ADVISOR_4);

        /** @var Classroom $classroom1 */
        $classroom1 = $this->getReference(LoadClassroomData::CELESTE);
        /** @var Classroom $classroom2 */
        $classroom2 = $this->getReference(LoadClassroomData::VERDE);

        /** @var Plan $plan1 */
        $plan1 = $this->getReference(LoadPlanData::PLAN_BASICO);

        /** @var MedicalHistory $medicalHistory1 */
        $medicalHistory1 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_1);
        /** @var MedicalHistory $medicalHistory2 */
        $medicalHistory2 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_2);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 1));
        $student->setCodeId($hashedId);
        $student->setIdNumber(86201589);
        $student->setBirthdate(new DateTime('now -3 years'));
        $student->setAddress('Mendoza 32');
        $student->setFirstName('Francisca');
        $student->setLastName('Gil');
        $student->setSex('Femenino');
        $student->setPhoto('student_1.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->addAdvisor($advisor1);
        $student->addAdvisor($advisor2);
        $student->setClassroom($classroom1);
        $student->setPlan($plan1);
        $student->setMedicalHistory($medicalHistory1);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 2));
        $student->setCodeId($hashedId);
        $student->setIdNumber(85106439);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Maipú 1209');
        $student->setFirstName('Ramiro');
        $student->setLastName('Fernandez');
        $student->setSex('Masculino');
        $student->setPhoto('student_2.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->addAdvisor($advisor3);
        $student->addAdvisor($advisor4);
        $student->setClassroom($classroom2);
        $student->setPlan($plan1);
        $student->setMedicalHistory($medicalHistory2);
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
            LoadAdvisorData::class,
            LoadClassroomData::class,
            LoadPlanData::class,
            LoadMedicalHistoryData::class
        ];
    }
}
