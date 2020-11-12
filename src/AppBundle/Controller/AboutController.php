<?php

namespace AppBundle\Controller;

use AppBundle\Entity\About;
use AppBundle\Form\AboutType;
use AppBundle\Repository\AboutRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AboutController.
 *
 * @Route("/about")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class AboutController extends AbstractController
{
    /**
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/create", name="about_create")
     */
    public function createAction(
        Request $request
    ): Response {
        $about = new About();
        $form = $this->createForm(
            AboutType::class,
            $about
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();
            $em->persist($about);
            $em->flush();

            $this->addFlash('success', 'La sección se creó con éxito!');

            return $this->redirectToRoute('about_list');
        }

        return $this->render(
            'AppBundle:About:create.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/list", name="about_list")
     */
    public function listAction(
        Request $request
    ): Response {
        $page = $request->query->get('page') ?? 1;
        $limit = $request->query->get('limit') ?? 20;

        /** @var AboutRepository $repository */
        $repository = $this->getRepository(About::class);

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
                'defaultSortFieldName' => 'about.id',
                'defaultSortDirection' => 'DESC'
            ]
        );

        return $this->render(
            'AppBundle:About:list.html.twig',
            [
                'table' => $data,
            ]
        );
    }

    /**
     * @param About $about
     *
     * @return Response
     *
     * @Route("/detail/{id}", name="about_detail")
     */
    public function detailAction(
        About $about
    ): Response {
        return $this->render(
            'AppBundle:About:detail.html.twig',
            [
                'about' => $about,
            ]
        );
    }

    /**
     * @Route("/delete/{id}", name="about_delete")
     *
     * @param About $about
     *
     * @return Response
     */
    public function deleteAction(
        About $about
    ): Response {
        $em = $this->getEntityManager();
        $em->remove($about);
        $em->flush();

        $this->addFlash('success', 'El registro se eliminó con éxito!');

        return $this->redirectToRoute('about_list');
    }

    /**
     * @Route("/edit/{id}", name="about_edit")
     *
     * @param About $about
     * @param Request $request
     *
     * @return Response
     */
    public function editAction(
        About $about,
        Request $request
    ): Response {
        $form = $this->createForm(
            AboutType::class,
            $about
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();
            $em->flush();

            $this->addFlash('success', 'La sección se editó con éxito!');

            return $this->redirectToRoute(
                'about_detail',
                ['id' => $about->getId()]
            );
        }

        return $this->render(
            'AppBundle:About:edit.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
