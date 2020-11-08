<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Settings;
use AppBundle\Form\SettingsType;
use AppBundle\Repository\SettingsRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SettingsController.
 *
 * @Route("/settings")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class SettingsController extends AbstractController
{
    /**
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/list", name="settings_list")
     */
    public function listAction(
        Request $request
    ): Response {
        $page = $request->query->get('page') ?? 1;
        $limit = $request->query->get('limit') ?? 20;

        /** @var SettingsRepository $repository */
        $repository = $this->getRepository(Settings::class);

        if (!empty($request->query->get('filter'))) {
            $query = $repository->findAllByFilter($request->query->get('filter'));
        } else {
            $query = $repository->findAllQuery();
        }

        $data = $this->getKnpPaginatorService()->paginate(
            $query,
            $page,
            $limit,
            [
                'defaultSortFieldName' => 'settings.id',
                'defaultSortDirection' => 'DESC'
            ]
        );

        return $this->render(
            'AppBundle:Settings:list.html.twig',
            [
                'table' => $data,
            ]
        );
    }

    /**
     * @param Settings $settings
     *
     * @return Response
     *
     * @Route("/detail/{id}", name="settings_detail")
     */
    public function detailAction(
        Settings $settings
    ): Response {
        return $this->render(
            'AppBundle:Settings:detail.html.twig',
            [
                'settings' => $settings,
            ]
        );
    }

    /**
     * @Route("/edit/{id}", name="settings_edit")
     *
     * @param Settings $settings
     * @param Request $request
     *
     * @return Response
     */
    public function editAction(
        Settings $settings,
        Request $request
    ): Response {
        $form = $this->createForm(
            SettingsType::class,
            $settings
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();
            $em->flush();

            $this->addFlash('success', 'El registro se editó con éxito!');

            return $this->redirectToRoute('settings_list');
        }

        return $this->render(
            'AppBundle:Settings:edit.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
