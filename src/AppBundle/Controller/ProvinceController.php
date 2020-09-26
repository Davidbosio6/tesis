<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Province;
use AppBundle\Form\ProvinceType;
use AppBundle\Repository\ProvinceRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ProvinceController.
 *
 * @Route("/province")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class ProvinceController extends AbstractController
{
    /**
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/create", name="province_create")
     */
    public function createAction(Request $request)
    {
        $province = new Province();
        $form = $this->createForm(
            ProvinceType::class,
            $province
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();
            $em->persist($province);
            $em->flush();

            $this->addFlash('info', 'La provincia se creó con éxito!');

            return $this->redirectToRoute('province_list');
        }

        return $this->render(
            'AppBundle:Province:create.html.twig',
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
     * @Route("/list", name="province_list")
     */
    public function listAction(Request $request)
    {
        $page = $request->query->get('page') ?? 1;
        $limit = $request->query->get('limit') ?? 20;

        /** @var ProvinceRepository $repository */
        $repository = $this->getRepository(Province::class);

        $query = $repository->findAllQuery();

        $data = $this->getKnpPaginator()->paginate(
            $query,
            $page,
            $limit,
            [
                'defaultSortFieldName' => 'province.name',
                'defaultSortDirection' => 'ASC'
            ]
        );

        return $this->render(
            'AppBundle:Province:list.html.twig',
            [
                'table' => $data,
            ]
        );
    }
}
