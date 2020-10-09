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


class LoadTeacherData extends AbstractFixture implements DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        /** @var User $user */
        $user = $this->getReference(LoadUserData::ADMIN);

        /** @var City $city */
        $city = $this->getReference(LoadCityData::SAMPACHO);

        /** @var Subject $subject */
        $subject = $this->getReference(LoadSubjectData::DIBUJO);

        $teacher = new Teacher();
        $teacher->setIdNumber(40297513);
        $teacher->setBirthdate(new DateTime('now -30 years'));
        $teacher->setAddress('9 de Julio 1120');
        $teacher->setPhoneNumber('3582413125');
        $teacher->setFirstName('Lore');
        $teacher->setLastName('Ipsum');
        $teacher->setUser($user);
        $teacher->setCity($city);
        $teacher->setSubject($subject);
        $manager->persist($teacher);

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            LoadUserData::class,
            LoadCityData::class,
        ];
    }
}
