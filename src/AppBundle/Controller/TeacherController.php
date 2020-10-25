<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Teacher;
use AppBundle\Form\ResetPasswordType;
use AppBundle\Form\TeacherType;
use AppBundle\Repository\TeacherRepository;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TeacherController.
 *
 * @Route("/teacher")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class TeacherController extends AbstractController
{
    /**
     * @Route("/create", name="teacher_create")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function createAction(
        Request $request
    ): Response {
        $teacher = new Teacher();
        $form = $this->createForm(
            TeacherType::class,
            $teacher,
            [
                'mode' => 'create'
            ]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this->getPasswordEncoderService()->encodePassword(
                $teacher->getUser(),
                $teacher->getUser()->getPlainPassword()
            );

            $teacher->getUser()->setPassword($password);

            $em = $this->getEntityManager();
            $em->persist($teacher);
            $em->flush();

            $this->addFlash('success', 'El profesor se creó con éxito!');

            return $this->redirectToRoute('teacher_list');
        }

        return $this->render(
            'AppBundle:Teacher:create.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/list", name="teacher_list")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function listAction(
        Request $request
    ): Response {
        $page = $request->query->get('page') ?? 1;
        $limit = $request->query->get('limit') ?? 20;

        /** @var TeacherRepository $repository */
        $repository = $this->getRepository(Teacher::class);

        $query = $repository->findAllQuery();

        $data = $this->getKnpPaginatorService()->paginate(
            $query,
            $page,
            $limit,
            [
                'defaultSortFieldName' => 'teacher.firstName',
                'defaultSortDirection' => 'ASC'
            ]
        );

        return $this->render(
            'AppBundle:Teacher:list.html.twig',
            [
                'table' => $data,
            ]
        );
    }

    /**
     * @Route("/detail/{id}", name="teacher_detail")
     *
     * @param Teacher $teacher
     *
     * @return Response
     */
    public function detailAction(
        Teacher $teacher
    ): Response {
        return $this->render(
            'AppBundle:Teacher:detail.html.twig',
            [
                'teacher' => $teacher,
                'yearsOld' => (new DateTime('now'))->diff($teacher->getBirthdate())->format('%y'),
            ]
        );
    }

    /**
     * @Route("/delete/{id}", name="teacher_delete")
     *
     * @param Teacher $teacher
     *
     * @return Response
     */
    public function deleteAction(
        Teacher $teacher
    ): Response {
        $em = $this->getEntityManager();
        $em->remove($teacher);
        $em->flush();

        $this->addFlash('success', 'El registro se eliminó con éxito!');

        return $this->redirectToRoute('teacher_list');
    }

    /**
     * @Route("/edit/{id}", name="teacher_edit")
     *
     * @param Teacher $teacher
     * @param Request $request
     *
     * @return Response
     */
    public function editAction(
        Teacher $teacher,
        Request $request
    ): Response {
        $form = $this->createForm(
            TeacherType::class,
            $teacher,
            [
                'mode' => 'edit'
            ]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();
            $em->flush();

            $this->addFlash('success', 'El profesor se editó con éxito!');

            return $this->redirectToRoute(
                'teacher_detail',
                ['id' => $teacher->getId()]
            );
        }

        return $this->render(
            'AppBundle:Teacher:edit.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/reset-password/{id}", name="teacher_reset_password")
     *
     * @param Request $request
     * @param Teacher $teacher
     *
     * @return Response
     */
    public function resetPasswordAction(
        Teacher $teacher,
        Request $request
    ): Response {
        $form = $this->createForm(
            ResetPasswordType::class,
            $teacher->getUser()
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this->getPasswordEncoderService()->encodePassword(
                $teacher->getUser(),
                $teacher->getUser()->getPlainPassword()
            );

            $teacher->getUser()->setPassword($password);

            $em = $this->getEntityManager();
            $em->persist($teacher);
            $em->flush();

            $this->addFlash('success', 'La contraseña se cambió con éxito!');

            return $this->redirectToRoute(
                'teacher_detail',
                ['id' => $teacher->getId()]
            );
        }

        return $this->render(
            'AppBundle:Teacher:reset_password.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
