<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Classroom;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ClassroomController.
 *
 * @Route("/classroom")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class ClassroomController extends AbstractController
{
    /**
     * @param Classroom $classroom
     *
     * @return Response
     *
     * @Route("/detail/{id}", name="classroom_detail")
     */
    public function detailAction(
        Classroom $classroom
    ): Response {
        return $this->render(
            'AppBundle:Classroom:detail.html.twig',
            [
                'classroom' => $classroom,
            ]
        );
    }
}
