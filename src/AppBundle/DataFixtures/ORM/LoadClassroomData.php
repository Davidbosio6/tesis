<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Classroom;
use AppBundle\Entity\Shift;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class LoadClassroomData.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class LoadClassroomData extends AbstractFixture implements FixtureInterface, DependentFixtureInterface
{
    const CELESTE = 'c_celeste';

    const VERDE = 'c_verde';

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        /** @var Shift $shift1 */
        $shift1 = $this->getReference(LoadShiftData::TURNO_MANIANA);
        /** @var Shift $shift2 */
        $shift2 = $this->getReference(LoadShiftData::TURNO_TARDE);

        $classroom = new Classroom();
        $classroom->setName('Celeste');
        $classroom->setDescription('Sala de 3');
        $classroom->setCapacity(26);
        $classroom->setShift($shift1);
        $manager->persist($classroom);
        $this->addReference(self::CELESTE, $classroom);

        $classroom = new Classroom();
        $classroom->setName('Verde');
        $classroom->setCapacity(30);
        $classroom->setDescription('Sala de 3');
        $classroom->setShift($shift2);
        $manager->persist($classroom);
        $this->addReference(self::VERDE, $classroom);

        $classroom = new Classroom();
        $classroom->setName('Amarilla');
        $classroom->setCapacity(13);
        $classroom->setDescription('Sala de 4');
        $classroom->setShift($shift1);
        $manager->persist($classroom);

        $classroom = new Classroom();
        $classroom->setName('Violeta');
        $classroom->setCapacity(28);
        $classroom->setDescription('Sala de 4');
        $classroom->setShift($shift2);
        $manager->persist($classroom);

        $classroom = new Classroom();
        $classroom->setName('Roja');
        $classroom->setCapacity(28);
        $classroom->setDescription('Sala de 5');
        $classroom->setShift($shift1);
        $manager->persist($classroom);

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies(): array
    {
        return [
            LoadShiftData::class
        ];
    }
}
