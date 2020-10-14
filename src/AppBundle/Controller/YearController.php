<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Year;
use AppBundle\Form\YearType;
use AppBundle\Repository\YearRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class YearController.
 *
 * @Route("/year")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class YearController extends AbstractController
{
    /**
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/create", name="year_create")
     */
    public function createAction(
        Request $request
    ): Response {
        $year = new Year();
        $form = $this->createForm(
            YearType::class,
            $year
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();
            $em->persist($year);
            $em->flush();

            $this->addFlash('success', 'El ciclo lectivo se creó con éxito!');

            return $this->redirectToRoute('year_list');
        }

        return $this->render(
            'AppBundle:Year:create.html.twig',
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
     * @Route("/list", name="year_list")
     */
    public function listAction(
        Request $request
    ): Response {
        $page = $request->query->get('page') ?? 1;
        $limit = $request->query->get('limit') ?? 20;

        /** @var YearRepository $repository */
        $repository = $this->getRepository(Year::class);

        $query = $repository->findAllQuery();

        $data = $this->getKnpPaginatorService()->paginate(
            $query,
            $page,
            $limit,
            [
                'defaultSortFieldName' => 'year.name',
                'defaultSortDirection' => 'ASC'
            ]
        );

        return $this->render(
            'AppBundle:Year:list.html.twig',
            [
                'table' => $data,
            ]
        );
    }

    /**
     * @param Year $year
     *
     * @return Response
     *
     * @Route("/detail/{id}", name="year_detail")
     */
    public function detailAction(
        Year $year
    ): Response {
        return $this->render(
            'AppBundle:Year:detail.html.twig',
            [
                'year' => $year,
            ]
        );
    }

    /**
     * @Route("/delete/{id}", name="year_delete")
     *
     * @param Year $year
     *
     * @return Response
     */
    public function deleteAction(
        Year $year
    ): Response {
        $em = $this->getEntityManager();

        $em->remove($year);
        $em->flush();

        $this->addFlash('success', 'El registro se eliminó con éxito!');

        return $this->redirectToRoute('year_list');
    }

    /**
     * @Route("/edit/{id}", name="year_edit")
     *
     * @param Year $year
     * @param Request $request
     *
     * @return Response
     */
    public function editAction(
        Year $year,
        Request $request
    ): Response {
        $form = $this->createForm(
            YearType::class,
            $year
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();
            $em->flush();

            $this->addFlash('success', 'El ciclo lectivo se editó con éxito!');

            return $this->redirectToRoute(
                'year_detail',
                ['id' => $year->getId()]
            );
        }

        return $this->render(
            'AppBundle:Year:edit.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
