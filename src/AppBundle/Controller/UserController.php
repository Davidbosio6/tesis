<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use AppBundle\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserController.
 *
 * @Route("/user")
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
     * @Route("/create", name="user_create")
     */
    public function createAction(Request $request)
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

            $this->addFlash('success', 'El usuario se creó con éxito!');

            return $this->redirectToRoute('user_list');
        }

        return $this->render(
            'AppBundle:User:create.html.twig',
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
     * @Route("/list", name="user_list")
     */
    public function listAction(Request $request)
    {
        $page = $request->query->get('page') ?? 1;
        $limit = $request->query->get('limit') ?? 20;

        /** @var UserRepository $repository */
        $repository = $this->getRepository(User::class);

        $query = $repository->findAllQuery();

        $data = $this->getKnpPaginator()->paginate(
            $query,
            $page,
            $limit,
            [
                'defaultSortFieldName' => 'user.id',
                'defaultSortDirection' => 'DESC'
            ]
        );

        return $this->render(
            'AppBundle:User:list.html.twig',
            [
                'table' => $data,
            ]
        );
    }
}
