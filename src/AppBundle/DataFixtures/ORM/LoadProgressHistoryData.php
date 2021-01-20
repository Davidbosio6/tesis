<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\ProgressHistory;
use AppBundle\Entity\Student;
use DateTime;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class LoadProgressHistoryData.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class LoadProgressHistoryData extends AbstractFixture implements FixtureInterface, DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        /** @var Student $student1 */
        $student1 = $this->getReference(LoadStudentData::STUDENT_1);

        $progressHistory = new ProgressHistory();
        $progressHistory->setTittle('Motriz');
        $progressHistory->setCreatedAt(new DateTime('now -3 months'));
        $progressHistory->setDescription('La alumna pudo tomar su desayuno sin ayuda');
        $progressHistory->setStudent($student1);
        $manager->persist($progressHistory);

        $progressHistory = new ProgressHistory();
        $progressHistory->setTittle('Cognitivo');
        $progressHistory->setCreatedAt(new DateTime('now -3 months'));
        $progressHistory->setDescription('La alumna aprendió a contar hasta 10');
        $progressHistory->setStudent($student1);
        $manager->persist($progressHistory);

        $progressHistory = new ProgressHistory();
        $progressHistory->setTittle('Cognitivo');
        $progressHistory->setDescription('La alumna aprendió a contar hasta 20');
        $progressHistory->setStudent($student1);
        $manager->persist($progressHistory);

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies(): array
    {
        return [
            LoadStudentData::class,
        ];
    }
}
