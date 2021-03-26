<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Installment;
use AppBundle\Entity\Student;
use AppBundle\Form\ProvinceType;
use AppBundle\Form\RegenerateInstallmentType;
use AppBundle\Repository\InstallmentRepository;
use AppBundle\Repository\StudentRepository;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
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
            if ($student->getPlan()->getAmount() > 0) {
                $this->getPagos360SdkService()->generateInstallments($student);
            }

            $this->getEntityManager()->flush();
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
     * @Route("/regenerate/{id}", name="installment_regenerate")
     *
     * @param Request $request
     * @param Installment $installment
     *
     * @return Response
     */
    public function regenerateAction(
        Request $request,
        Installment $installment
    ): Response {
        $form = $this->createForm(
            RegenerateInstallmentType::class
        );

        $student = $installment->getStudent();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                if ($student->getPlan()->getAmount() > 0) {
                    $this->getPagos360SdkService()->regenerateInstallment(
                        $installment,
                        $form->get('amount')->getData(),
                        $form->get('dueDate')->getData()
                    );
                }

                $this->getEntityManager()->flush();

                $this->addFlash('success', 'Cuota regenerada con éxito!');

                return $this->redirectToRoute(
                    'student_detail',
                    ['id' => $student->getId()]
                );
            } catch (Exception $e) {
                $this->addFlash('error', $e->getMessage());

                return $this->redirectToRoute(
                    'student_detail',
                    ['id' => $student->getId()]
                );
            }
        }

        return $this->render(
            'AppBundle:Installment:regenerate.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/list", name="installment_list")
     *
     * @param Request $request
     * @return Response
     */
    public function listAction(
        Request $request
    ): Response {
        $page = $request->query->get('page') ?? 1;
        $limit = $request->query->get('limit') ?? 20;

        /** @var InstallmentRepository $repository */
        $repository = $this->getRepository(Installment::class);

        $data = $this->getKnpPaginatorService()->paginate(
            $repository->findAll(),
            $page,
            $limit,
            [
                'defaultSortFieldName' => 'id',
                'defaultSortDirection' => 'DESC'
            ]
        );


        return $this->render(
            'AppBundle:Installment:list.html.twig',
            [
                'table' => $data,
            ]
        );
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
                if ($student->getPlan()->getAmount() > 0) {
                    $this->getPagos360SdkService()->generateInstallments($student);
                }
            }

            $this->getEntityManager()->flush();
        } catch (Exception $e) {
            $this->addFlash('error', $e->getMessage());

            return $this->redirectToRoute('installment_list');
        }

        $this->addFlash('success', 'Cuotas generadas con para ' . count($students) . ' Usuarios');

        return $this->redirectToRoute('installment_list');
    }

    /**
     * @Route("/sync-up", name="installment_sync_up")
     *
     * @return Response
     */
    public function syncUpAction(): Response {
        /** @var InstallmentRepository $repository */
        $repository = $this->getRepository(Installment::class);
        $installments = $repository->findBy([
            'state' => 'Pendiente'
        ]);

        $response = $this->getPagos360SdkService()->syncUpInstallments($installments);
        $this->addFlash('success', 'Se han sincronizado ' . $response . ' cuotas');

        $this->getEntityManager()->flush();

        return $this->redirectToRoute('installment_list');
    }
}
