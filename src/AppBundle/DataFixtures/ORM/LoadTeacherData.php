<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\City;
use AppBundle\Entity\Subject;
use AppBundle\Entity\Teacher;
use AppBundle\Entity\User;
use DateTime;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class LoadTeacherData.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class LoadTeacherData extends AbstractFixture implements DependentFixtureInterface
{
    const TEACHER_1 = 't_teacher_1';
    const TEACHER_2 = 't_teacher_2';
    const TEACHER_3 = 't_teacher_3';
    const TEACHER_4 = 't_teacher_4';
    const TEACHER_5 = 't_teacher_5';
    const TEACHER_6 = 't_teacher_6';

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        /** @var User $user1 */
        $user1 = $this->getReference(LoadUserData::USER_1);
        /** @var User $user2 */
        $user2 = $this->getReference(LoadUserData::USER_2);
        /** @var User $user3 */
        $user3 = $this->getReference(LoadUserData::USER_3);
        /** @var User $user4 */
        $user4 = $this->getReference(LoadUserData::USER_4);
        /** @var User $user5 */
        $user5 = $this->getReference(LoadUserData::USER_5);
        /** @var User $user6 */
        $user6 = $this->getReference(LoadUserData::USER_6);

        /** @var City $city1 */
        $city1 = $this->getReference(LoadCityData::SAMPACHO);
        /** @var City $city2 */
        $city2 = $this->getReference(LoadCityData::CNEL_MOLDES);
        /** @var City $city3 */
        $city3 = $this->getReference(LoadCityData::RIO_CUARTO);
        /** @var City $city4 */
        $city4 = $this->getReference(LoadCityData::VILLA_MERCEDES);

        /** @var Subject $subject1 */
        $subject1 = $this->getReference(LoadSubjectData::DIBUJO);
        /** @var Subject $subject2 */
        $subject2 = $this->getReference(LoadSubjectData::MUSICA);
        /** @var Subject $subject3 */
        $subject3 = $this->getReference(LoadSubjectData::LECTURA);
        /** @var Subject $subject4 */
        $subject4 = $this->getReference(LoadSubjectData::EF);
        /** @var Subject $subject5 */
        $subject5 = $this->getReference(LoadSubjectData::LYC);
        /** @var Subject $subject6 */
        $subject6 = $this->getReference(LoadSubjectData::DYA);

        $teacher = new Teacher();
        $teacher->setIdNumber(19203928);
        $teacher->setBirthdate(new DateTime('now -30 years'));
        $teacher->setAddress('9 de Julio 1120');
        $teacher->setPhoneNumber('3582413125');
        $teacher->setFirstName('David');
        $teacher->setLastName('Bosio');
        $teacher->setPhoto('teacher_1.png');
        $teacher->setUser($user1);
        $teacher->setCity($city1);
        $teacher->setSubject($subject1);
        $this->addReference(self::TEACHER_1, $teacher);
        $manager->persist($teacher);

        $teacher = new Teacher();
        $teacher->setIdNumber(18291003);
        $teacher->setBirthdate(new DateTime('yesterday -42 years'));
        $teacher->setAddress('Santa Fe 198');
        $teacher->setPhoneNumber('3582414579');
        $teacher->setFirstName('Elizabeth');
        $teacher->setLastName('Grant');
        $teacher->setPhoto('teacher_2.png');
        $teacher->setUser($user2);
        $teacher->setCity($city2);
        $teacher->setSubject($subject2);
        $this->addReference(self::TEACHER_2, $teacher);
        $manager->persist($teacher);

        $teacher = new Teacher();
        $teacher->setIdNumber(16492382);
        $teacher->setBirthdate(new DateTime('+1 month -40 years'));
        $teacher->setAddress('Fructuoso Rivera 31');
        $teacher->setPhoneNumber('3582434579');
        $teacher->setFirstName('Samuel');
        $teacher->setLastName('Smith');
        $teacher->setPhoto('teacher_3.png');
        $teacher->setUser($user3);
        $teacher->setCity($city3);
        $teacher->setSubject($subject3);
        $this->addReference(self::TEACHER_3, $teacher);
        $manager->persist($teacher);

        $teacher = new Teacher();
        $teacher->setIdNumber(21412979);
        $teacher->setBirthdate(new DateTime('+5 months -23 years'));
        $teacher->setAddress('Obispo Oro 1220');
        $teacher->setPhoneNumber('3582456789');
        $teacher->setFirstName('Adam');
        $teacher->setLastName('Levine');
        $teacher->setPhoto('teacher_4.png');
        $teacher->setUser($user4);
        $teacher->setCity($city2);
        $teacher->setSubject($subject4);
        $this->addReference(self::TEACHER_4, $teacher);
        $manager->persist($teacher);

        $teacher = new Teacher();
        $teacher->setIdNumber(21482902);
        $teacher->setBirthdate(new DateTime('+4 months -31 years'));
        $teacher->setAddress('Sucre 2900');
        $teacher->setPhoneNumber('3582412321');
        $teacher->setFirstName('Dalila');
        $teacher->setLastName('Molina');
        $teacher->setPhoto('teacher_5.png');
        $teacher->setUser($user5);
        $teacher->setCity($city3);
        $teacher->setSubject($subject5);
        $this->addReference(self::TEACHER_5, $teacher);
        $manager->persist($teacher);

        $teacher = new Teacher();
        $teacher->setIdNumber(20498502);
        $teacher->setBirthdate(new DateTime('+1 months -32 years'));
        $teacher->setAddress('Alvear 302');
        $teacher->setPhoneNumber('3582404982');
        $teacher->setFirstName('Selena');
        $teacher->setLastName('Gomez');
        $teacher->setPhoto('teacher_6.png');
        $teacher->setUser($user6);
        $teacher->setCity($city4);
        $teacher->setSubject($subject6);
        $manager->persist($teacher);
        $this->addReference(self::TEACHER_6, $teacher);

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies(): array
    {
        return [
            LoadUserData::class,
            LoadCityData::class,
        ];
    }
}
