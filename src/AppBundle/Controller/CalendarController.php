<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Calendar;
use AppBundle\Entity\Classroom;
use AppBundle\Form\CalendarType;
use Exception;
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
            $classroom->setCalendar($calendar);

            try {
                $this->getGoogleSdkService()->createCalendar(
                    $calendar,
                    $this->getParameter('kernel.project_dir')
                );
            } catch (Exception | Throwable $e) {
                $this->addFlash('error', $e->getMessage());

                return $this->redirectToRoute(
                    'classroom_detail',
                    ['id' => $classroom->getId()]
                );
            }

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
