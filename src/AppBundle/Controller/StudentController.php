<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Advisor;
use AppBundle\Entity\Classroom;
use AppBundle\Entity\Student;
use AppBundle\Form\SelectEmailType;
use AppBundle\Form\SelectUserForSignUpType;
use AppBundle\Form\SignUpType;
use AppBundle\Form\StudentPreSignUpType;
use AppBundle\Form\StudentType;
use AppBundle\Repository\StudentRepository;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

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
     * @Route("/pre-sign-up", name="student_pre_sign_up")
     */
    public function preSignUpAction(
        Request $request
    ): Response {
        $student = new Student();
        $form = $this->createForm(
            StudentPreSignUpType::class,
            $student
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();
            $em->persist($student);
            $em->flush();

            $hashedId = strtoupper(hash('crc32', $student->getId()));
            $student->setCodeId($hashedId);

            $em->flush();

            $this->addFlash('success', 'Operación realizada con éxito!');

            return $this->redirectToRoute('dashboard');
        }

        return $this->render(
            'AppBundle:Student:pre-sign-up.html.twig',
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
     * @Route("/select-user-for-sign-up", name="student_select_user_for_sign_up")
     */
    public function selectUserForSignUpAction(
        Request $request
    ): Response {
        $form = $this->createForm(SelectUserForSignUpType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute(
                'student_sign_up',
                ['id' => $form->get('student')->getData()]
            );
        }

        return $this->render(
            'AppBundle:Student:select-user-for-sign-up.html.twig',
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
     * @Route("/sign-up/{id}", name="student_sign_up")
     */
    public function signUpAction(
        Request $request,
        Student $student
    ): Response {
        $form = $this->createForm(
            SignUpType::class,
            $student,
            [
                'mode' => 'create'
            ]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();

            /** @var Classroom $classroom */
            $classroom = $em->getRepository(Classroom::class)->find($student->getClassroom());
            $student->setClassroom($classroom);

            if (!empty($form['photo']->getData())) {
                $fileName = sprintf('student_%s.png', $student->getId());

                $form['photo']->getData()->move(
                    $this->getParameter('kernel.project_dir') . '/web/public/students',
                    $fileName
                );

                $student->setPhoto($fileName);
            }

            if (!empty($student->getGenerateInstallments())) {
                try {
                    if ($student->getPlan()->getAmount() > 0) {
                        $this->getPagos360SdkService()->generateInstallments($student);
                    }
                } catch (Exception $e) {
                    $this->addFlash('warning', 'Ocurrió un error mientras se generaban las cuotas!');
                }
            }

            if (!empty($student->getAdvisors())) {
                /** @var Advisor $advisor */
                foreach ($student->getAdvisors() as $advisor) {
                    try {
                        $this->getSendgridSdkService()->sendWelcomeEmail(
                            $student,
                            $advisor->getEmail(),
                            $advisor->getFullName()
                        );
                    } catch (Exception | Throwable $e) {
                        //@TODO save exception
                    }
                }
            }

            $em->flush();

            $this->addFlash('success', 'El alumno se inscribió con éxito!');

            return $this->redirectToRoute('student_list');
        }

        return $this->render(
            'AppBundle:Student:sign-up.html.twig',
            [
                'student' => $student,
                'form' => $form->createView(),
            ]
        );
    }

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
            $student,
            [
                'mode' => 'create'
            ]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();

            /** @var Classroom $classroom */
            $classroom = $em->getRepository(Classroom::class)->find($student->getClassroom());
            $student->setClassroom($classroom);

            if (!empty($form['photo']->getData())) {
                $fileName = sprintf('student_%s.png', $student->getId());

                $form['photo']->getData()->move(
                    $this->getParameter('kernel.project_dir') . '/web/public/students',
                    $fileName
                );

                $student->setPhoto($fileName);
            }

            if (!empty($student->getGenerateInstallments())) {
                try {
                    if ($student->getPlan()->getAmount() > 0) {
                        $this->getPagos360SdkService()->generateInstallments($student);
                    }
                } catch (Exception $e) {
                    $this->addFlash('warning', 'Ocurrió un error mientras se generaban las cuotas!');
                }
            }

            $em->persist($student);
            $em->flush();

            $hashedId = strtoupper(hash('crc32', $student->getId()));
            $student->setCodeId($hashedId);

            if (!empty($student->getAdvisors())) {
                /** @var Advisor $advisor */
                foreach ($student->getAdvisors() as $advisor) {
                    try {
                        $this->getSendgridSdkService()->sendWelcomeEmail(
                            $student,
                            $advisor->getEmail(),
                            $advisor->getFullName()
                        );
                    } catch (Exception | Throwable $e) {
                        //@TODO save exception
                    }
                }
            }

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
                'defaultSortFieldName' => 'student.id',
                'defaultSortDirection' => 'DESC'
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
     * @param Student $student
     *
     * @return Response
     *
     * @Route("/delete/{id}", name="student_delete")
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
     * @param Student $student
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/edit/{id}", name="student_edit")
     */
    public function editAction(
        Student $student,
        Request $request
    ): Response {
        $form = $this->createForm(
            StudentType::class,
            $student,
            [
                'mode' => 'edit'
            ]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();

            /** @var Classroom $classroom */
            $classroom = $em->getRepository(Classroom::class)->find($student->getClassroom());
            $student->setClassroom($classroom);

            if (!empty($form['photo']->getData())) {
                $fileName = sprintf('student_%s.png', $student->getId());

                $form['photo']->getData()->move(
                    $this->getParameter('kernel.project_dir') . '/web/public/students',
                    $fileName
                );

                $student->setPhoto($fileName);
            }

            $em->flush();

            $this->addFlash('success', 'El alumno se editó con éxito!');

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

    /**
     * @param Request $request
     * @param Student $student
     *
     * @return Response
     *
     * @Route("/forward-welcome-email/{id}", name="student_forward_welcome_email")
     */
    public function forwardWelcomeEmailAction(
        Request $request,
        Student $student
    ): Response {
        $form = $this->createForm(
            SelectEmailType::class,
            null,
            [
                'student' => $student
            ]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var Advisor $advisor */
            $advisor = $this->getRepository(Advisor::class)->find(
                $form->get('advisor')->getData()
            );

            $this->getSendgridSdkService()->sendWelcomeEmail(
                $student,
                $advisor->getEmail(),
                $advisor->getFullName()
            );

            $this->addFlash('success', 'Correo enviado con éxito!');

            return $this->redirectToRoute(
                'student_detail',
                ['id' => $student->getId()]
            );
        }

        return $this->render(
            'AppBundle:Student:select-email.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @param Student $student
     *
     * @return Response
     *
     * @Route("/medical-history/{id}", name="student_show_medical_history")
     */
    public function showMedicalHistoryAction(
        Student $student
    ): Response {
        return $this->render(
            'AppBundle:Student:medical-history.html.twig',
            [
                'student' => $student,
            ]
        );
    }
}
