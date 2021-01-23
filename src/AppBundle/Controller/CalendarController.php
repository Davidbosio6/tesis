<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Calendar;
use AppBundle\Entity\Classroom;
use AppBundle\Entity\Event;
use AppBundle\Form\CalendarType;
use DateTime;
use Exception;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * Class CalendarController.
 *
 * @Route("/calendar")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class CalendarController extends AbstractController
{
    /**
     * @param Request $request
     * @param Classroom $classroom
     *
     * @return Response
     *
     * @Route("/create/{id}", name="calendar_create")
     */
    public function createAction(
        Request $request,
        Classroom $classroom
    ): Response {
        $calendar = new Calendar();
        $form = $this->createForm(
            CalendarType::class,
            $calendar
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();
            $em->persist($calendar);

            try {
                $url = $this->getParameter('kernel.project_dir') . '/web/public/credentials.json';

                putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $url);

                $client = new Google_Client();
                $client->setScopes(Google_Service_Calendar::CALENDAR_EVENTS);
                $client->useApplicationDefaultCredentials();
                $client->setApprovalPrompt('force');

                $calendarService = new Google_Service_Calendar($client);
                /** @var Event $event */
                foreach ($calendar->getEvents() as $event){

                    $startDateTime = sprintf('%sT%s-03:00',
                        (new DateTime())->format('Y-m-d'),
                        $event->getStartHour()->format('H:i:s')
                    );

                    $startEvent = new Google_Service_Calendar_EventDateTime();
                    $startEvent->setDateTime($startDateTime);
                    $startEvent->setTimeZone('America/Argentina/Buenos_Aires');

                    $endDateTime = sprintf('%sT%s-03:00',
                        (new DateTime())->format('Y-m-d'),
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

                    $calendarService->events->insert($calendar->getGoogleId(), $googleEvent);
                }
            } catch (Exception | Throwable $e ) {
                $this->addFlash('error', $e->getMessage());

                return $this->redirectToRoute(
                    'classroom_detail',
                    ['id' => $classroom->getId()]
                );
            }

            $classroom->setCalendar($calendar);
            $em->flush();

            $this->addFlash('success', 'El calendario se creó con éxito!');

            return $this->redirectToRoute(
                'classroom_detail',
                ['id' => $classroom->getId()]
            );
        }

        return $this->render(
            'AppBundle:Calendar:create.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
