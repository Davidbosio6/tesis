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
    public function createAction(Request $request)
    {
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

            $this->addFlash('info', 'El país se creó con éxito!');

            return $this->redirectToRoute('country_list');
        }

        return $this->render(
            'AppBundle:Country:create.html.twig',
            [
                'form'=>$form->createView(),
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
    public function listAction(Request $request)
    {
        $page = $request->query->get('page') ?? 1;
        $limit = $request->query->get('limit') ?? 20;

        /** @var CountryRepository $repository */
        $repository = $this->getRepository(Country::class);

        $query = $repository->findAllQuery();

        $data = $this->getKnpPaginator()->paginate(
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
}
