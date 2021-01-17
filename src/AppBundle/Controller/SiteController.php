<?php

namespace AppBundle\Controller;

use AppBundle\Entity\About;
use AppBundle\Entity\Plan;
use AppBundle\Entity\Settings;
use AppBundle\Entity\Shift;
use AppBundle\Entity\Student;
use AppBundle\Form\CodeIdType;
use AppBundle\Repository\AboutRepository;
use AppBundle\Repository\PlanRepository;
use AppBundle\Repository\SettingsRepository;
use AppBundle\Repository\ShiftRepository;
use AppBundle\Repository\StudentRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SiteController.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class SiteController extends AbstractController
{
    /**
     * @Route("/", name="index")
     *
     * @return Response
     */
    public function indexAction(): Response
    {
        return $this->render('AppBundle:Site:index.html.twig', [
            'siteName' => $this->getSiteName()
        ]);
    }

    /**
     * @Route("/about", name="about")
     *
     * @return Response
     */
    public function aboutAction(): Response
    {
        /** @var AboutRepository $repository */
        $repository = $this->getRepository(About::class);

        return $this->render('AppBundle:Site:about.html.twig', [
            'siteName' => $this->getSiteName(),
            'sections' => $repository->findAllByShowAbout(true)
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     *
     * @return Response
     */
    public function contactAction(): Response
    {
        /** @var SettingsRepository $repository */
        $repository = $this->getRepository(Settings::class);
        $location = $repository->findOneByCode(SettingsRepository::CONTACT_LOCATION_CODE);
        $phone = $repository->findOneByCode(SettingsRepository::CONTACT_PHONE_CODE);
        $email = $repository->findOneByCode(SettingsRepository::CONTACT_EMAIL_CODE);
        $scheduleDays = $repository->findOneByCode(SettingsRepository::CONTACT_SCHEDULE_DAYS_CODE);
        $scheduleHours = $repository->findOneByCode(SettingsRepository::CONTACT_SCHEDULE_HOURS_CODE);

        return $this->render('AppBundle:Site:contact.html.twig', [
            'siteName' => $this->getSiteName(),
            'location' => $location->getValue(),
            'phone' => $phone->getValue(),
            'email' => $email->getValue(),
            'scheduleDays' => $scheduleDays->getValue(),
            'scheduleHours' => $scheduleHours->getValue()
        ]);
    }

    /**
     * @Route("/login", name="login")
     *
     * @return Response
     */
    public function loginAction(): Response
    {
        $error = $this->getAuthenticationUtilsService()->getLastAuthenticationError();

        $lastUsername = $this->getAuthenticationUtilsService()->getLastUsername();

        return $this->render('AppBundle:Site:login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'siteName' => $this->getSiteName()

        ]);
    }

    /**
     * @Route("/plans", name="plans")
     *
     * @return Response
     */
    public function plansAction(): Response
    {
        /** @var PlanRepository $repository */
        $repository = $this->getRepository(Plan::class);

        return $this->render('AppBundle:Site:plans.html.twig', [
            'siteName' => $this->getSiteName(),
            'plans' => $repository->findAllByShowPlan(true)
        ]);
    }

    /**
     * @Route("/dashboard", name="dashboard")
     *
     * @return Response
     */
    public function dashboardAction(): Response
    {
        /** @var StudentRepository $studentRepository */
        $studentRepository = $this->getRepository(Student::class);
        $male = $studentRepository->findAllBySex('Masculino');
        $female = $studentRepository->findAllBySex('Femenino');
        $undefined = $studentRepository->findAllBySex('No define');

        /** @var ShiftRepository $shiftRepository */
        $shiftRepository = $this->getRepository(Shift::class);
        $shifts = $shiftRepository->findAll();
        $shiftNames = [];
        $classrooms= [];
        /** @var Shift $shift */
        foreach ($shifts as $shift) {
            $shiftNames[] = $shift->getName();
            $classrooms[] = $shift->getClassrooms()->count();
        }

        return $this->render('AppBundle:Site:dashboard.html.twig', [
            'sexes' => sprintf("%s, %s, %s", count($male), count($female), count($undefined)),
            'shiftNames' => json_encode($shiftNames),
            'classrooms' => json_encode($classrooms),
        ]);
    }

    /**
     * @Route("/installments/pay/select-user", name="installments_pay_select_user")
     *
     * @param  Request $request
     *
     * @return Response
     */
    public function InstallmentsPaySelectUserAction(
        Request $request
    ): Response {
        $form = $this->createForm(
            CodeIdType::class
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Student $student */
            $student = $this->getRepository(Student::class)->findOneBy([
                'codeId' => $form->get('codeId')->getData()
            ]);

            if (empty($student)) {
                $this->addFlash('error', 'El ID ingresado es incorrecto');

                return $this->render('AppBundle:Site:installments-pay-select-user.html.twig', [
                    'siteName' => $this->getSiteName(),
                    'form' => $form->createView()
                ]);
            }

            return $this->redirectToRoute(
                'installments_pay_select_installment',
                ['codeId' => $student->getCodeId()]
            );
        }

        return $this->render('AppBundle:Site:installments-pay-select-user.html.twig', [
            'siteName' => $this->getSiteName(),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/installments/pay/{{codeId}}/select-installment", name="installments_pay_select_installment")
     *
     * @param  Student $student
     *
     * @return Response
     */
    public function InstallmentsPaySelectInstallmentAction(
        Student $student
    ): Response {
        return $this->render('AppBundle:Site:installments-pay-select-installment.html.twig', [
            'siteName' => $this->getSiteName(),
            'student' => $student,
        ]);
    }
}
