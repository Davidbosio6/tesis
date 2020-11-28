<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Installment;
use AppBundle\Entity\Settings;
use AppBundle\Entity\Student;
use AppBundle\Repository\SettingsRepository;
use DateTime;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
use Exception;
use GuzzleHttp\Client as HttpClient;
use Knp\Component\Pager\Paginator as KnpPaginator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Throwable;

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
     * @param $class
     * @return ObjectRepository
     */
    public function getRepository($class): ObjectRepository
    {
        return $this->getDoctrine()->getManager()->getRepository($class);
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

    /**
     * @return KnpPaginator
     */
    protected function getKnpPaginatorService(): KnpPaginator
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->get('knp_paginator');
    }

    /**
     * @return string
     */
    public function getSiteName(): string
    {
        /** @var SettingsRepository $repository */
        $repository = $this->getRepository(Settings::class);
        $siteName = $repository->findOneByCode(SettingsRepository::SITE_NAME_CODE);

        return $siteName->getValue();
    }

    /**
     * @param Student $student
     */
    public function generateInstallments(
        Student $student
    ): void {
        $monthNumber = (new DateTime())->format('m');
        $installmentQuantity = 12 - $monthNumber;

        $monthTranslate = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];

        for ($i = 1; $i <= $installmentQuantity; $i++) {
            $date = date_create(sprintf(
                '%s-%s-%s',
                (new DateTime())->format('Y'),
                (new DateTime())->modify('+' . $i . 'month')->format('m'),
                15,
            ));

            $installment = new Installment();
            $installment->setAmount($student->getPlan()->getAmount())
                ->setState(Installment::PENDING_STATE)
                ->setMonth($monthTranslate[intval($monthNumber)])
                ->setDueDate($date)
                ->setStudent($student);

            $this->getEntityManager()->persist($installment);

            $body = [
                'payment_request' => [
                    'description' => $installment->getMonth(),
                    'first_due_date' => $installment->getDueDate()->format('d-m-Y'),
                    'first_total' => floatval($installment->getAmount()),
                    'payer_name' => $student->getFullName()
                ]
            ];

            try {
                $client = new HttpClient([
                    'base_uri' => 'https://sandboxapi.pagos360.com/',
                    'exceptions' => true,
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Bearer ' . $this->getParameter('pagos360_api_key')
                    ]
                ]);

                $response = $client->request(
                    'POST',
                    'payment-request',
                    ['body' => json_encode($body)]
                );

                $jsonResponse = json_decode((string)$response->getBody());

                $installment->setCheckoutUrl($jsonResponse->checkout_url);
            } catch (Exception $e) {
                $this->getEntityManager()->remove($installment);

                throw new Exception('Ocurrió un error mientras se generaban las cuotas!');
            } catch (Throwable $e) {
                $this->getEntityManager()->remove($installment);

                throw new Exception('Ocurrió un error mientras se generaban las cuotas!');
            }
        }
    }
}
