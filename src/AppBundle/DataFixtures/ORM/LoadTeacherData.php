<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\City;
use AppBundle\Entity\Teacher;
use AppBundle\Entity\User;
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

        $teacher = new Teacher();
        $teacher->setFirstName('Lore');
        $teacher->setLastName('Ipsum');
        $teacher->setUser($user);
        $teacher->setCity($city);
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
