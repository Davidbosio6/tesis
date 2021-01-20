<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ProgressHistory;
use AppBundle\Entity\Student;
use AppBundle\Form\ProgressHistoryType;
use AppBundle\Repository\ProgressHistoryRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Class ProgressHistoryController.
 *
 * @Route("/student")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class ProgressHistoryController extends AbstractController
{
    /**
     * @param Request $request
     * @param Student $student
     *
     * @return Response
     *
     * @Route("/{id}/progress-history/create", name="progress_history_create")
     */
    public function createAction(
        Request $request,
        Student $student
    ): Response {
        $progressHistory = new ProgressHistory();
        $progressHistory->setStudent($student);

        $form = $this->createForm(
            ProgressHistoryType::class,
            $progressHistory
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();
            $em->persist($progressHistory);
            $em->flush();

            $this->addFlash('success', 'El registro se creó con éxito!');

            return $this->redirectToRoute(
                'progress_history_list',
                ['id' => $student->getId()]
            );
        }

        return $this->render(
            'AppBundle:ProgressHistory:create.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @param Request $request
     * @param Student $student
     *
     * @return Response
     *
     * @Route("/{id}/progress-history", name="progress_history_list")
     */
    public function listAction(
        Request $request,
        Student $student
    ): Response {
        $page = $request->query->get('page') ?? 1;
        $limit = $request->query->get('limit') ?? 20;

        /** @var ProgressHistoryRepository $repository */
        $repository = $this->getRepository(ProgressHistory::class);
        $query = $repository->findAllByStudent($student);

        $data = $this->getKnpPaginatorService()->paginate(
            $query,
            $page,
            $limit,
            [
                'defaultSortFieldName' => 'progressHistory.id',
                'defaultSortDirection' => 'DESC'
            ]
        );

        return $this->render(
            'AppBundle:ProgressHistory:list.html.twig',
            [
                'student' => $student,
                'data' => $data,
            ]
        );
    }

    /**
     * @param Request $request
     * @param Student $student
     * @param ProgressHistory $progressHistory
     *
     * @return Response
     *
     * @Route("/{studentId}/progress-history/edit/{progressHistoryId}", name="progress_history_edit")
     *
     * @ParamConverter(
     *     "student",
     *     class="AppBundle:Student",
     *     options={"id" = "studentId"}
     * ),
     * @ParamConverter(
     *     "progressHistory",
     *     class="AppBundle:ProgressHistory",
     *     options={"id" = "progressHistoryId"}
     * )
     */
    public function editAction(
        Request $request,
        Student $student,
        ProgressHistory $progressHistory
    ): Response {

        $form = $this->createForm(
            ProgressHistoryType::class,
            $progressHistory
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();
            $em->flush();

            $this->addFlash('success', 'El registro se editó con éxito!');

            return $this->redirectToRoute(
                'progress_history_list',
                ['id' => $student->getId()]
            );
        }

        return $this->render(
            'AppBundle:ProgressHistory:edit.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @param Student $student
     * @param ProgressHistory $progressHistory
     *
     * @return Response
     *
     * @Route("/{studentId}/progress-history/delete/{progressHistoryId}", name="progress_history_delete")
     *
     * @ParamConverter(
     *     "student",
     *     class="AppBundle:Student",
     *     options={"id" = "studentId"}
     * ),
     * @ParamConverter(
     *     "progressHistory",
     *     class="AppBundle:ProgressHistory",
     *     options={"id" = "progressHistoryId"}
     * )
     */
    public function deleteAction(
        Student $student,
        ProgressHistory $progressHistory
    ): Response {
        $em = $this->getEntityManager();

        $em->remove($progressHistory);
        $em->flush();

        $this->addFlash('success', 'El registro se eliminó con éxito!');

        return $this->redirectToRoute(
            'progress_history_list',
            ['id' => $student->getId()]
        );
    }
}
