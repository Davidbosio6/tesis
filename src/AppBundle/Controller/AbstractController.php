<?php

namespace AppBundle\Controller;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class AbstractController.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class AbstractController extends Controller
{
    /**
     * @return ObjectManager
     */
    public function getEntityManager(): ObjectManager
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->getDoctrine()->getManager();
    }

    /**
     * @return AuthenticationUtils
     */
    public function getAuthenticationUtilsService(): AuthenticationUtils
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->get('security.authentication_utils');
    }

    /**
     * @return UserPasswordEncoder
     */
    public function getPasswordEncoderService(): UserPasswordEncoder
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->get('security.password_encoder');
    }
}
