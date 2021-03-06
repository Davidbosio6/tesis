<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Installment;
use AppBundle\Entity\Plan;
use AppBundle\Entity\Student;
use AppBundle\Form\PlanType;
use AppBundle\Repository\PlanRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PlanController.
 *
 * @Route("/plan")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class PlanController extends AbstractController
{
    /**
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/create", name="plan_create")
     */
    public function createAction(
        Request $request
    ): Response {
        $plan = new Plan();
        $form = $this->createForm(
            PlanType::class,
            $plan
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();
            $em->persist($plan);
            $em->flush();

            $this->addFlash('success', 'El plan se creó con éxito!');

            return $this->redirectToRoute('plan_list');
        }

        return $this->render(
            'AppBundle:Plan:create.html.twig',
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
     * @Route("/list", name="plan_list")
     */
    public function listAction(
        Request $request
    ): Response {
        $page = $request->query->get('page') ?? 1;
        $limit = $request->query->get('limit') ?? 20;

        /** @var PlanRepository $repository */
        $repository = $this->getRepository(Plan::class);

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
                'defaultSortFieldName' => 'plan.id',
                'defaultSortDirection' => 'DESC'
            ]
        );

        return $this->render(
            'AppBundle:Plan:list.html.twig',
            [
                'table' => $data,
            ]
        );
    }

    /**
     * @param Plan $plan
     *
     * @return Response
     *
     * @Route("/detail/{id}", name="plan_detail")
     */
    public function detailAction(
        Plan $plan
    ): Response {
        return $this->render(
            'AppBundle:Plan:detail.html.twig',
            [
                'plan' => $plan,
            ]
        );
    }

    /**
     * @Route("/delete/{id}", name="plan_delete")
     *
     * @param Plan $plan
     *
     * @return Response
     */
    public function deleteAction(
        Plan $plan
    ): Response {
        $em = $this->getEntityManager();

        if (!$plan->getStudents()->isEmpty()) {
            $this->addFlash('error', 'El registro no se ha podido eliminar ya que se encuentra asociado a uno o más alumnos');

            return $this->redirectToRoute(
                'plan_detail',
                ['id' => $plan->getId()]
            );
        }

        $em->remove($plan);
        $em->flush();

        $this->addFlash('success', 'El registro se eliminó con éxito!');

        return $this->redirectToRoute('plan_list');
    }

    /**
     * @Route("/edit/{id}", name="plan_edit")
     *
     * @param Plan $plan
     * @param Request $request
     *
     * @return Response
     */
    public function editAction(
        Plan $plan,
        Request $request
    ): Response {
        $amountBeforeForm = $plan->getAmount();

        $form = $this->createForm(
            PlanType::class,
            $plan
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();
            $amountAfterForm = $plan->getAmount();

            if ($amountAfterForm !== $amountBeforeForm && $amountAfterForm != 0) {
                $students = $plan->getStudents();

                if (!$students->isEmpty()) {
                    /** @var Student $student */
                    foreach ($students as $student) {
                        $installments = $student->getInstallments();
                        if (!$installments->isEmpty()) {
                            /** @var Installment $installment */
                            foreach ($installments as $installment) {
                                if ($installment->getState() === Installment::PENDING_STATE) {
                                    $this->getPagos360SdkService()->regenerateInstallmentFromPlan(
                                        $installment,
                                        $amountAfterForm
                                    );

                                    $em->remove($installment);
                                }
                            }
                        }
                    }
                }
            }

            $em->flush();

            $this->addFlash('success', 'El plan se editó con éxito!');

            return $this->redirectToRoute(
                'plan_detail',
                ['id' => $plan->getId()]
            );
        }

        return $this->render(
            'AppBundle:Plan:edit.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
