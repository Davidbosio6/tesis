<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/", name="index")
     */
    public function indexAction(Request $request)
    {
        return $this->render('AppBundle:Layout:index.html.twig');
    }

    /**
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/about", name="about")
     */
    public function aboutAction(Request $request)
    {
        return $this->render('AppBundle:Layout:about.html.twig');
    }

    /**
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/contact", name="contact")
     */
    public function contactAction(Request $request)
    {
        return $this->render('AppBundle:Layout:contact.html.twig');
    }

    /**
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $error = $this->getAuthenticationUtilsService()->getLastAuthenticationError();

        $lastUsername = $this->getAuthenticationUtilsService()->getLastUsername();

        return $this->render('AppBundle:Layout:login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    /**
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboardAction(Request $request)
    {
        return $this->render('AppBundle:Layout:dashboard.html.twig');
    }
}
