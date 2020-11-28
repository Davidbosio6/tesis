<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Student;
use AppBundle\Repository\StudentRepository;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class YearController.
 *
 * @Route("/installment")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class InstallmentController extends AbstractController
{
    /**
     * @Route("/generate/{id}", name="installment_generate")
     *
     * @param Student $student
     *
     * @return Response
     */
    public function generateAction(
        Student $student
    ): Response {
        try {
            $this->generateInstallments($student);
        } catch (Exception $e) {
            $this->addFlash('error', $e->getMessage());

            return $this->redirectToRoute(
                'student_detail',
                ['id' => $student->getId()]
            );
        }

        $this->addFlash('success', 'Cuotas generadas con éxito!');

        return $this->redirectToRoute(
            'student_detail',
            ['id' => $student->getId()]
        );
    }

    /**
     * @Route("/list", name="installment_list")
     *
     * @return Response
     */
    public function listAction(): Response {
        return $this->render('AppBundle:Installment:list.html.twig');
    }

    /**
     * @Route("/generate-all", name="installment_generate_all")
     *
     * @return Response
     */
    public function generateAllAction(): Response {
        try {
            /** @var StudentRepository $studentRepository */
            $studentRepository = $this->getRepository(Student::class);
            $students = $studentRepository->findAllByInstallmentsGenerated(false);

            foreach ($students as $student) {
                $this->generateInstallments($student);
            }

            $this->getEntityManager()->flush();
        } catch (Exception $e) {
            $this->addFlash('error', $e->getMessage());

            return $this->redirectToRoute('installment_list');
        }

        $this->addFlash('success', 'Cuotas generadas con para ' . count($students) . 'Usuarios');

        return $this->redirectToRoute('installment_list');
    }
}
