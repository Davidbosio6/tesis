<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Advisor;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AdvisorController.
 *
 * @Route("/advisor")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class AdvisorController extends AbstractController
{
    /**
     * @param Advisor $advisor
     *
     * @return Response
     *
     * @Route("/detail/{id}", name="advisor_detail")
     */
    public function detailAction(
        Advisor $advisor
    ): Response {
        return $this->render(
            'AppBundle:Advisor:detail.html.twig',
            [
                'advisor' => $advisor,
                'yearsOld' => (new DateTime('now'))->diff($advisor->getBirthdate())->format('%y'),
            ]
        );
    }
}
