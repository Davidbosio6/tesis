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
    public function createAction(
        Request $request
    ): Response {
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

            $this->addFlash('success', 'La provincia se creó con éxito!');

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
    public function listAction(
        Request $request
    ): Response {
        $page = $request->query->get('page') ?? 1;
        $limit = $request->query->get('limit') ?? 20;

        /** @var ProvinceRepository $repository */
        $repository = $this->getRepository(Province::class);

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
                'defaultSortFieldName' => 'province.id',
                'defaultSortDirection' => 'DESC'
            ]
        );

        return $this->render(
            'AppBundle:Province:list.html.twig',
            [
                'table' => $data,
            ]
        );
    }

    /**
     * @param Province $province
     *
     * @return Response
     *
     * @Route("/detail/{id}", name="province_detail")
     */
    public function detailAction(
        Province $province
    ): Response {
        return $this->render(
            'AppBundle:Province:detail.html.twig',
            [
                'province' => $province,
            ]
        );
    }

    /**
     * @Route("/delete/{id}", name="province_delete")
     *
     * @param Province $province
     *
     * @return Response
     */
    public function deleteAction(
        Province $province
    ): Response {
        $em = $this->getEntityManager();

        if (!$province->getCities()->isEmpty()) {
            $this->addFlash('error', 'Este registro no se ha podido eliminar ya que se encuentra asociado a una o mas ciudades');

            return $this->redirectToRoute(
                'province_detail',
                ['id' => $province->getId()]
            );
        }

        $em->remove($province);
        $em->flush();

        $this->addFlash('success', 'El registro se eliminó con éxito!');

        return $this->redirectToRoute('province_list');
    }

    /**
     * @Route("/edit/{id}", name="province_edit")
     *
     * @param Province $province
     * @param Request $request
     *
     * @return Response
     */
    public function editAction(
        Province $province,
        Request $request
    ): Response {
        $form = $this->createForm(
            ProvinceType::class,
            $province
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();
            $em->flush();

            $this->addFlash('success', 'La provincia se editó con éxito!');

            return $this->redirectToRoute(
                'province_detail',
                ['id' => $province->getId()]
            );
        }

        return $this->render(
            'AppBundle:Province:edit.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
