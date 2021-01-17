<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Shift;
use AppBundle\Form\ShiftType;
use AppBundle\Repository\ShiftRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ShiftController.
 *
 * @Route("/shift")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class ShiftController extends AbstractController
{
    /**
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/create", name="shift_create")
     */
    public function createAction(
        Request $request
    ): Response {
        $shift = new Shift();
        $form = $this->createForm(
            ShiftType::class,
            $shift
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();
            $em->persist($shift);
            $em->flush();

            $this->addFlash('success', 'El turno se creó con éxito!');

            return $this->redirectToRoute('shift_list');
        }

        return $this->render(
            'AppBundle:Shift:create.html.twig',
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
     * @Route("/list", name="shift_list")
     */
    public function listAction(
        Request $request
    ): Response {
        $page = $request->query->get('page') ?? 1;
        $limit = $request->query->get('limit') ?? 20;

        /** @var ShiftRepository $repository */
        $repository = $this->getRepository(Shift::class);

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
                'defaultSortFieldName' => 'shift.id',
                'defaultSortDirection' => 'DESC'
            ]
        );

        return $this->render(
            'AppBundle:Shift:list.html.twig',
            [
                'table' => $data,
            ]
        );
    }

    /**
     * @param Shift $shift
     *
     * @return Response
     *
     * @Route("/detail/{id}", name="shift_detail")
     */
    public function detailAction(
        Shift $shift
    ): Response {
        return $this->render(
            'AppBundle:Shift:detail.html.twig',
            [
                'shift' => $shift,
            ]
        );
    }

    /**
     * @Route("/delete/{id}", name="shift_delete")
     *
     * @param Shift $shift
     *
     * @return Response
     */
    public function deleteAction(
        Shift $shift
    ): Response {
        $em = $this->getEntityManager();

        foreach ($shift->getClassrooms() as $classroom) {
            if (!$classroom->getStudents()->isEmpty()) {
                $this->addFlash('error', 'Este turno no se ha podido eliminar ya que se encuentra asociado a uno o mas alumnos');

                return $this->redirectToRoute(
                    'shift_detail',
                    ['id' => $shift->getId()]
                );
            }
        }

        $em->remove($shift);
        $em->flush();

        $this->addFlash('success', 'El registro se eliminó con éxito!');

        return $this->redirectToRoute('shift_list');
    }

    /**
     * @Route("/edit/{id}", name="shift_edit")
     *
     * @param Shift $shift
     * @param Request $request
     *
     * @return Response
     */
    public function editAction(
        Shift $shift,
        Request $request
    ): Response {
        $form = $this->createForm(
            ShiftType::class,
            $shift
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();
            $em->flush();

            $this->addFlash('success', 'El turno se editó con éxito!');

            return $this->redirectToRoute(
                'shift_detail',
                ['id' => $shift->getId()]
            );
        }

        return $this->render(
            'AppBundle:Shift:edit.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
