<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Student;
use AppBundle\Form\StudentType;
use AppBundle\Repository\StudentRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class StudentController.
 *
 * @Route("/student")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class StudentController extends AbstractController
{
    /**
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/create", name="student_create")
     */
    public function createAction(
        Request $request
    ): Response {
        $student = new Student();
        $form = $this->createForm(
            StudentType::class,
            $student
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();
            $em->persist($student);
            $em->flush();

            $this->addFlash('success', 'El alumno se creó con éxito!');

            return $this->redirectToRoute('student_list');
        }

        return $this->render(
            'AppBundle:Student:create.html.twig',
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
     * @Route("/list", name="student_list")
     */
    public function listAction(
        Request $request
    ): Response {
        $page = $request->query->get('page') ?? 1;
        $limit = $request->query->get('limit') ?? 20;

        /** @var StudentRepository $repository */
        $repository = $this->getRepository(Student::class);

        $query = $repository->findAllQuery();

        $data = $this->getKnpPaginatorService()->paginate(
            $query,
            $page,
            $limit,
            [
                'defaultSortFieldName' => 'student.firstName',
                'defaultSortDirection' => 'ASC'
            ]
        );

        return $this->render(
            'AppBundle:Student:list.html.twig',
            [
                'table' => $data,
            ]
        );
    }

    /**
     * @param Student $student
     *
     * @return Response
     *
     * @Route("/detail/{id}", name="student_detail")
     */
    public function detailAction(
        Student $student
    ): Response {
        return $this->render(
            'AppBundle:Student:detail.html.twig',
            [
                'student' => $student,
            ]
        );
    }

    /**
     * @Route("/delete/{id}", name="student_delete")
     *
     * @param Student $student
     *
     * @return Response
     */
    public function deleteAction(
        Student $student
    ): Response {
        $em = $this->getEntityManager();
        $em->remove($student);
        $em->flush();

        $this->addFlash('success', 'El registro se eliminó con éxito!');

        return $this->redirectToRoute('student_list');
    }

    /**
     * @Route("/edit/{id}", name="student_edit")
     *
     * @param Student $student
     * @param Request $request
     *
     * @return Response
     */
    public function editAction(
        Student $student,
        Request $request
    ): Response {
        $form = $this->createForm(
            StudentType::class,
            $student
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();
            $em->flush();

            $this->addFlash('success', 'El profesor se editó con éxito!');

            return $this->redirectToRoute(
                'student_detail',
                ['id' => $student->getId()]
            );
        }

        return $this->render(
            'AppBundle:Student:edit.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}