<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Settings;
use AppBundle\Repository\SettingsRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SiteController.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class SiteController extends AbstractController
{
    /**
     * @return Response
     *
     * @Route("/", name="index")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Layout:index.html.twig', [
            'siteName' => $this->getSiteName()
        ]);
    }

    /**
     * @return Response
     *
     * @Route("/about", name="about")
     */
    public function aboutAction()
    {
        return $this->render('AppBundle:Layout:about.html.twig', [
            'siteName' => $this->getSiteName()
        ]);
    }

    /**
     * @return Response
     *
     * @Route("/contact", name="contact")
     */
    public function contactAction()
    {
        /** @var SettingsRepository $repository */
        $repository = $this->getRepository(Settings::class);
        $location = $repository->findOneByCode(SettingsRepository::CONTACT_LOCATION_CODE);
        $phone = $repository->findOneByCode(SettingsRepository::CONTACT_PHONE_CODE);
        $email = $repository->findOneByCode(SettingsRepository::CONTACT_EMAIL_CODE);
        $scheduleDays = $repository->findOneByCode(SettingsRepository::CONTACT_SCHEDULE_DAYS_CODE);
        $scheduleHours = $repository->findOneByCode(SettingsRepository::CONTACT_SCHEDULE_HOURS_CODE);

        return $this->render('AppBundle:Layout:contact.html.twig', [
            'siteName' => $this->getSiteName(),
            'location' => $location->getValue(),
            'phone' => $phone->getValue(),
            'email' => $email->getValue(),
            'scheduleDays' => $scheduleDays->getValue(),
            'scheduleHours' => $scheduleHours->getValue()
        ]);
    }

    /**
     * @return Response
     *
     * @Route("/login", name="login")
     */
    public function loginAction()
    {
        $error = $this->getAuthenticationUtilsService()->getLastAuthenticationError();

        $lastUsername = $this->getAuthenticationUtilsService()->getLastUsername();

        return $this->render('AppBundle:Layout:login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'siteName' => $this->getSiteName()

        ]);
    }

    /**
     * @return Response
     *
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboardAction()
    {
        return $this->render('AppBundle:Layout:dashboard.html.twig');
    }
}
