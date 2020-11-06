<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Country;
use AppBundle\Form\CountryType;
use AppBundle\Repository\CountryRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CountryController.
 *
 * @Route("/country")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class CountryController extends AbstractController
{
    /**
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/create", name="country_create")
     */
    public function createAction(
        Request $request
    ): Response {
        $country = new Country();
        $form = $this->createForm(
            CountryType::class,
            $country
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();
            $em->persist($country);
            $em->flush();

            $this->addFlash('success', 'El país se creó con éxito!');

            return $this->redirectToRoute('country_list');
        }

        return $this->render(
            'AppBundle:Country:create.html.twig',
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
     * @Route("/list", name="country_list")
     */
    public function listAction(
        Request $request
    ): Response {
        $page = $request->query->get('page') ?? 1;
        $limit = $request->query->get('limit') ?? 20;

        /** @var CountryRepository $repository */
        $repository = $this->getRepository(Country::class);

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
                'defaultSortFieldName' => 'country.name',
                'defaultSortDirection' => 'ASC'
            ]
        );

        return $this->render(
            'AppBundle:Country:list.html.twig',
            [
                'table' => $data,
            ]
        );
    }

    /**
     * @param Country $country
     *
     * @return Response
     *
     * @Route("/detail/{id}", name="country_detail")
     */
    public function detailAction(
        Country $country
    ): Response {
        return $this->render(
            'AppBundle:Country:detail.html.twig',
            [
                'country' => $country,
            ]
        );
    }

    /**
     * @Route("/delete/{id}", name="country_delete")
     *
     * @param Country $country
     *
     * @return Response
     */
    public function deleteAction(
        Country $country
    ): Response {
        $em = $this->getEntityManager();

        if (!$country->getProvinces()->isEmpty()) {
            $this->addFlash('error', 'Este registro no se ha podido eliminar ya que se encuentra asociado a una o más provincias');

            return $this->redirectToRoute(
                'country_detail',
                ['id' => $country->getId()]
            );
        }

        $em->remove($country);
        $em->flush();

        $this->addFlash('success', 'El registro se eliminó con éxito!');

        return $this->redirectToRoute('country_list');
    }

    /**
     * @Route("/edit/{id}", name="country_edit")
     *
     * @param Country $country
     * @param Request $request
     *
     * @return Response
     */
    public function editAction(
        Country $country,
        Request $request
    ): Response {
        $form = $this->createForm(
            CountryType::class,
            $country
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();
            $em->flush();

            $this->addFlash('success', 'El pais se editó con éxito!');

            return $this->redirectToRoute(
                'country_detail',
                ['id' => $country->getId()]
            );
        }

        return $this->render(
            'AppBundle:Country:edit.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
