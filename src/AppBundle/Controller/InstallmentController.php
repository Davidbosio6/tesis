<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Student;
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
}
