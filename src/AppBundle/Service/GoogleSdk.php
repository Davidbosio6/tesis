<?php

namespace AppBundle\Service;

use AppBundle\Entity\Calendar;
use AppBundle\Entity\Event;
use AppBundle\Entity\Settings;
use AppBundle\Repository\SettingsRepository;
use DateTime;
use Doctrine\ORM\EntityManager;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("app.service.google_sdk")
 */
class GoogleSdk
{
    private $em;

    /**
     * @param EntityManager $em
     *
     * @DI\InjectParams({
     *     "em" = @DI\Inject("doctrine.orm.entity_manager")
     * })
     */
    public function __constructor(
        EntityManager $em
    ) {
        $this->em = $em;
    }

    /**
     * @param Calendar $calendar
     * @param string $dir
     */
    public function createCalendar(
        Calendar $calendar,
        string $dir
    ): void {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $dir . '/web/public/credentials.json');

        $client = new Google_Client();
        $client->setScopes(Google_Service_Calendar::CALENDAR_EVENTS);
        $client->useApplicationDefaultCredentials();
        $client->setApprovalPrompt('force');

        /** @var SettingsRepository $repository */
        $repository = $this->em->getRepository(Settings::class);
        $untilDate = $repository->findOneByCode(SettingsRepository::CALENDAR_LAST_DAY_CODE)->getValue();
        $sinceDate = $repository->findOneByCode(SettingsRepository::CALENDAR_INIT_DAY_CODE)->getValue();

        $arrayUntilDate = explode('-', $untilDate);
        $until = $arrayUntilDate[2] . $arrayUntilDate[1] . $arrayUntilDate[0];

        $calendarService = new Google_Service_Calendar($client);
        /** @var Event $event */
        foreach ($calendar->getEvents() as $event) {
            $startDateTime = sprintf('%sT%s-03:00',
                DateTime::createFromFormat('m-d-Y', $sinceDate)->modify('next ' . $event->getDayWeek())->format('Y-m-d'),
                $event->getStartHour()->format('H:i:s')
            );

            $startEvent = new Google_Service_Calendar_EventDateTime();
            $startEvent->setDateTime($startDateTime);
            $startEvent->setTimeZone('America/Argentina/Buenos_Aires');

            $endDateTime = sprintf('%sT%s-03:00',
                DateTime::createFromFormat('m-d-Y', $sinceDate)->modify('next ' . $event->getDayWeek())->format('Y-m-d'),
                $event->getEndHour()->format('H:i:s')
            );

            $endEvent = new Google_Service_Calendar_EventDateTime();
            $endEvent->setDateTime($endDateTime);
            $endEvent->setTimeZone('America/Argentina/Buenos_Aires');

            $googleEvent = new Google_Service_Calendar_Event();
            $googleEvent->setSummary($event->getName());
            $googleEvent->setRecurrence(['RRULE:FREQ=WEEKLY;UNTIL=' . $until . 'T170000Z']);
            $googleEvent->setStart($startEvent);
            $googleEvent->setEnd($endEvent);

            $response = $calendarService->events->insert($calendar->getGoogleId(), $googleEvent);
            $event->setEventId($response->id);
        }
    }

    /**
     * @param Calendar $calendar
     * @param string $eventId
     * @param string $dir
     */
    public function deleteEvent(
        Calendar $calendar,
        string $eventId,
        string $dir
    ): void {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $dir . '/web/public/credentials.json');

        $client = new Google_Client();
        $client->setScopes(Google_Service_Calendar::CALENDAR_EVENTS);
        $client->useApplicationDefaultCredentials();
        $client->setApprovalPrompt('force');

        $calendarService = new Google_Service_Calendar($client);
        $calendarService->events->delete($calendar->getGoogleId(), $eventId);
    }
}
