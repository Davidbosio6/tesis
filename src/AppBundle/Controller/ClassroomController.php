<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Classroom;
use AppBundle\Form\ClassroomType;
use AppBundle\Repository\ClassroomRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
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
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/create", name="classroom_create")
     */
    public function createAction(
        Request $request
    ): Response {
        $classroom = new Classroom();
        $form = $this->createForm(
            ClassroomType::class,
            $classroom
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();
            $em->persist($classroom);
            $em->flush();

            $this->addFlash('success', 'La sala se creó con éxito!');

            return $this->redirectToRoute('classroom_list');
        }

        return $this->render(
            'AppBundle:Classroom:create.html.twig',
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
     * @Route("/list", name="classroom_list")
     */
    public function listAction(
        Request $request
    ): Response {
        $page = $request->query->get('page') ?? 1;
        $limit = $request->query->get('limit') ?? 20;

        /** @var ClassroomRepository $repository */
        $repository = $this->getRepository(Classroom::class);

        $query = $repository->findAllQuery();

        $data = $this->getKnpPaginator()->paginate(
            $query,
            $page,
            $limit,
            [
                'defaultSortFieldName' => 'classroom.name',
                'defaultSortDirection' => 'ASC'
            ]
        );

        return $this->render(
            'AppBundle:Classroom:list.html.twig',
            [
                'table' => $data,
            ]
        );
    }

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

    /**
     * @Route("/delete/{id}", name="classroom_delete")
     *
     * @param Classroom $classroom
     *
     * @return Response
     */
    public function deleteAction(
        Classroom $classroom
    ): Response {
        $em = $this->getEntityManager();

        $em->remove($classroom);
        $em->flush();

        $this->addFlash('success', 'El registro se eliminó con éxito!');

        return $this->redirectToRoute('classroom_list');
    }

    /**
     * @Route("/edit/{id}", name="classroom_edit")
     *
     * @param Classroom $classroom
     * @param Request $request
     *
     * @return Response
     */
    public function editAction(
        Classroom $classroom,
        Request $request
    ): Response {
        $form = $this->createForm(
            ClassroomType::class,
            $classroom
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();
            $em->flush();

            $this->addFlash('success', 'El turno se editó con éxito!');

            return $this->redirectToRoute(
                'classroom_detail',
                ['id' => $classroom->getId()]
            );
        }

        return $this->render(
            'AppBundle:Classroom:edit.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
