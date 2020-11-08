<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Subject;
use AppBundle\Form\SubjectType;
use AppBundle\Repository\SubjectRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SubjectController.
 *
 * @Route("/subject")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class SubjectController extends AbstractController
{
    /**
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/create", name="subject_create")
     */
    public function createAction(
        Request $request
    ): Response {
        $subject = new Subject();
        $form = $this->createForm(
            SubjectType::class,
            $subject
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();
            $em->persist($subject);
            $em->flush();

            $this->addFlash('success', 'La asignatura se creó con éxito!');

            return $this->redirectToRoute('subject_list');
        }

        return $this->render(
            'AppBundle:Subject:create.html.twig',
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
     * @Route("/list", name="subject_list")
     */
    public function listAction(
        Request $request
    ): Response {
        $page = $request->query->get('page') ?? 1;
        $limit = $request->query->get('limit') ?? 20;

        /** @var SubjectRepository $repository */
        $repository = $this->getRepository(Subject::class);

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
                'defaultSortFieldName' => 'subject.id',
                'defaultSortDirection' => 'DESC'
            ]
        );

        return $this->render(
            'AppBundle:Subject:list.html.twig',
            [
                'table' => $data,
            ]
        );
    }

    /**
     * @param Subject $subject
     *
     * @return Response
     *
     * @Route("/detail/{id}", name="subject_detail")
     */
    public function detailAction(
        Subject $subject
    ): Response {
        return $this->render(
            'AppBundle:Subject:detail.html.twig',
            [
                'subject' => $subject,
            ]
        );
    }

    /**
     * @Route("/delete/{id}", name="subject_delete")
     *
     * @param Subject $subject
     *
     * @return Response
     */
    public function deleteAction(
        Subject $subject
    ): Response {
        $em = $this->getEntityManager();

        if (!$subject->getTeachers()->isEmpty()) {
            $this->addFlash('error', 'Este registro no se ha podido eliminar ya que se encuentra asociado a uno o más profesores');

            return $this->redirectToRoute(
                'subject_detail',
                ['id' => $subject->getId()]
            );
        }

        $em->remove($subject);
        $em->flush();

        $this->addFlash('success', 'El registro se eliminó con éxito!');

        return $this->redirectToRoute('subject_list');
    }

    /**
     * @Route("/edit/{id}", name="subject_edit")
     *
     * @param Subject $subject
     * @param Request $request
     *
     * @return Response
     */
    public function editAction(
        Subject $subject,
        Request $request
    ): Response {
        $form = $this->createForm(
            SubjectType::class,
            $subject
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();
            $em->flush();

            $this->addFlash('success', 'La asignatura se editó con éxito!');

            return $this->redirectToRoute(
                'subject_detail',
                ['id' => $subject->getId()]
            );
        }

        return $this->render(
            'AppBundle:Subject:edit.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
