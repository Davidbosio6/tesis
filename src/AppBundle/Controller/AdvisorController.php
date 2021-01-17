<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Advisor;
use AppBundle\Form\UploadPhotoType;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @param Advisor $advisor
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/change-photo/{id}", name="advisor_change_photo")
     */
    public function changePhotoAction(
        Advisor $advisor,
        Request $request
    ): Response {
        $form = $this->createForm(UploadPhotoType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();

            if (!empty($form['photo']->getData())) {
                $fileName = sprintf('advisor_%s.png', $advisor->getId());

                $form['photo']->getData()->move(
                    $this->getParameter('kernel.project_dir') . '/web/public/advisors',
                    $fileName
                );

                $advisor->setPhoto($fileName);
            }

            $em->flush();

            $this->addFlash('success', 'La Foto se cargo con éxito!');

            return $this->redirectToRoute(
                'advisor_detail',
                ['id' => $advisor->getId()]
            );
        }

        return $this->render(
            'AppBundle:Advisor:change-photo.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
