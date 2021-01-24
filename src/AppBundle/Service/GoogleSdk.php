<?php

namespace AppBundle\Service;

use AppBundle\Entity\Calendar;
use AppBundle\Entity\Event;
use DateTime;
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

        $calendarService = new Google_Service_Calendar($client);
        /** @var Event $event */
        foreach ($calendar->getEvents() as $event) {
            $startDateTime = sprintf('%sT%s-03:00',
                (new DateTime())->modify('next '. $event->getDayWeek())->format('Y-m-d'),
                $event->getStartHour()->format('H:i:s')
            );

            $startEvent = new Google_Service_Calendar_EventDateTime();
            $startEvent->setDateTime($startDateTime);
            $startEvent->setTimeZone('America/Argentina/Buenos_Aires');

            $endDateTime = sprintf('%sT%s-03:00',
                (new DateTime())->modify('next '. $event->getDayWeek())->format('Y-m-d'),
                $event->getEndHour()->format('H:i:s')
            );

            $endEvent = new Google_Service_Calendar_EventDateTime();
            $endEvent->setDateTime($endDateTime);
            $endEvent->setTimeZone('America/Argentina/Buenos_Aires');

            $googleEvent = new Google_Service_Calendar_Event();
            $googleEvent->setSummary($event->getName());
            $googleEvent->setRecurrence(array('RRULE:FREQ=WEEKLY;UNTIL=20220701T170000Z'));
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
