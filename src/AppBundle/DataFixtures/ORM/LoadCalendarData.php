<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Calendar;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class LoadCalendarData extends AbstractFixture implements FixtureInterface
{
    const CALENDAR_1 = 'c_calendar_1';

    const CALENDAR_2 = 'c_calendar_2';

    const CALENDAR_3 = 'c_calendar_3';

    const CALENDAR_4 = 'c_calendar_4';

    const CALENDAR_5 = 'c_calendar_5';

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $calendar = new Calendar();
        $calendar->setGoogleId('tl6d0556sd82g5h81thidbpgd4@group.calendar.google.com');
        $manager->persist($calendar);
        $this->addReference(self::CALENDAR_1, $calendar);

        $calendar = new Calendar();
        $calendar->setGoogleId('mqp5lqva8itn20g85fv7740ehk@group.calendar.google.com');
        $manager->persist($calendar);
        $this->addReference(self::CALENDAR_2, $calendar);

        $calendar = new Calendar();
        $calendar->setGoogleId('8r704ennm5o0io2h6uu8kvtdbg@group.calendar.google.com');
        $manager->persist($calendar);
        $this->addReference(self::CALENDAR_3, $calendar);

        $calendar = new Calendar();
        $calendar->setGoogleId('4135k9u1e9lkgbihj9aq8h7bq8@group.calendar.google.com');
        $manager->persist($calendar);
        $this->addReference(self::CALENDAR_4, $calendar);

        $calendar = new Calendar();
        $calendar->setGoogleId('ns8uq2osko3q6emonr8i3f1c0s@group.calendar.google.com');
        $manager->persist($calendar);
        $this->addReference(self::CALENDAR_5, $calendar);

        $manager->flush();
    }
}
