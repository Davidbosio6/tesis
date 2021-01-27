<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Calendar;
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

        /** @var Calendar $calendar1 */
        $calendar1 = $this->getReference(LoadCalendarData::CALENDAR_1);
        /** @var Calendar $calendar2 */
        $calendar2 = $this->getReference(LoadCalendarData::CALENDAR_2);
        /** @var Calendar $calendar3 */
        $calendar3 = $this->getReference(LoadCalendarData::CALENDAR_3);
        /** @var Calendar $calendar4 */
        $calendar4 = $this->getReference(LoadCalendarData::CALENDAR_4);
        /** @var Calendar $calendar5 */
        $calendar5 = $this->getReference(LoadCalendarData::CALENDAR_5);

        $classroom = new Classroom();
        $classroom->setName('Celeste');
        $classroom->setDescription('Sala de 3');
        $classroom->setCapacity(25);
        $classroom->setShift($shift1);
        $classroom->setCalendar($calendar3);
        $manager->persist($classroom);
        $this->addReference(self::CELESTE, $classroom);

        $classroom = new Classroom();
        $classroom->setName('Verde');
        $classroom->setCapacity(22);
        $classroom->setDescription('Sala de 3');
        $classroom->setShift($shift2);
        $classroom->setCalendar($calendar1);
        $manager->persist($classroom);
        $this->addReference(self::VERDE, $classroom);

        $classroom = new Classroom();
        $classroom->setName('Amarilla');
        $classroom->setCapacity(13);
        $classroom->setDescription('Sala de 4');
        $classroom->setShift($shift1);
        $classroom->setCalendar($calendar4);
        $manager->persist($classroom);

        $classroom = new Classroom();
        $classroom->setName('Violeta');
        $classroom->setCapacity(23);
        $classroom->setDescription('Sala de 4');
        $classroom->setShift($shift2);
        $classroom->setCalendar($calendar2);
        $manager->persist($classroom);

        $classroom = new Classroom();
        $classroom->setName('Roja');
        $classroom->setCapacity(25);
        $classroom->setDescription('Sala de 5');
        $classroom->setShift($shift1);
        $classroom->setCalendar($calendar5);
        $manager->persist($classroom);

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies(): array
    {
        return [
            LoadShiftData::class,
            LoadCalendarData::class
        ];
    }
}
