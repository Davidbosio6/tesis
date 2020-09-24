<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserController.
 *
 * @Route("/user", name="index")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class UserController extends AbstractController
{
    /**
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/create", name="create_user")
     */
    public function indexAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm(
            UserType::class,
            $user
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this->getPasswordEncoderService()->encodePassword(
                $user,
                $user->getPlainPassword()
            );

            $user->setPassword($password);

            $em = $this->getEntityManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('info', 'La adhesión se editó con éxito!');

            return $this->redirectToRoute('index');
        }

        return $this->render(
            'AppBundle:User:create.html.twig',
            [
                'form'=>$form->createView(),
            ]
        );
    }
}
