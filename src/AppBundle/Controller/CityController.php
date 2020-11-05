<?php

namespace AppBundle\Controller;

use AppBundle\Entity\City;
use AppBundle\Form\CityType;
use AppBundle\Repository\CityRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CityController.
 *
 * @Route("/city")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class CityController extends AbstractController
{
    /**
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/create", name="city_create")
     */
    public function createAction(
        Request $request
    ): Response {
        $city = new City();
        $form = $this->createForm(
            CityType::class,
            $city
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();
            $em->persist($city);
            $em->flush();

            $this->addFlash('success', 'La ciudad se creó con éxito!');

            return $this->redirectToRoute('city_list');
        }

        return $this->render(
            'AppBundle:City:create.html.twig',
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
     * @Route("/list", name="city_list")
     */
    public function listAction(
        Request $request
    ): Response {
        $page = $request->query->get('page') ?? 1;
        $limit = $request->query->get('limit') ?? 20;

        /** @var CityRepository $repository */
        $repository = $this->getRepository(City::class);

        $query = $repository->findAllQuery();

        $data = $this->getKnpPaginatorService()->paginate(
            $query,
            $page,
            $limit,
            [
                'defaultSortFieldName' => 'city.name',
                'defaultSortDirection' => 'ASC'
            ]
        );

        return $this->render(
            'AppBundle:City:list.html.twig',
            [
                'table' => $data,
            ]
        );
    }

    /**
     * @param City $city
     *
     * @return Response
     *
     * @Route("/detail/{id}", name="city_detail")
     */
    public function detailAction(
        City $city
    ): Response {
        return $this->render(
            'AppBundle:City:detail.html.twig',
            [
                'city' => $city,
            ]
        );
    }

    /**
     * @Route("/delete/{id}", name="city_delete")
     *
     * @param City $city
     *
     * @return Response
     */
    public function deleteAction(
        City $city
    ): Response {
        $em = $this->getEntityManager();

        if (!$city->getTeachers()->isEmpty() || !$city->getAdvisors()->isEmpty() || !$city->getStudents()->isEmpty()) {
            $this->addFlash('error', 'Esta ciudad no se ha podido eliminar ya que se encuentra asociado a uno o más registros');

            return $this->redirectToRoute(
                'city_detail',
                ['id' => $city->getId()]
            );
        }

        $em->remove($city);
        $em->flush();

        $this->addFlash('success', 'El registro se eliminó con éxito!');

        return $this->redirectToRoute('city_list');
    }

    /**
     * @Route("/edit/{id}", name="city_edit")
     *
     * @param City $city
     * @param Request $request
     *
     * @return Response
     */
    public function editAction(
        City $city,
        Request $request
    ): Response {
        $form = $this->createForm(
            CityType::class,
            $city
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();
            $em->flush();

            $this->addFlash('success', 'La ciudad se editó con éxito!');

            return $this->redirectToRoute(
                'city_detail',
                ['id' => $city->getId()]
            );
        }

        return $this->render(
            'AppBundle:City:edit.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
