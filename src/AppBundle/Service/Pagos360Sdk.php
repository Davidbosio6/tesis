<?php

namespace AppBundle\Service;

use AppBundle\Entity\Installment;
use AppBundle\Entity\Student;
use DateTime;
use Doctrine\ORM\EntityManager;
use Exception;
use JMS\DiExtraBundle\Annotation as DI;
use GuzzleHttp\Client as HttpClient;
use Throwable;

/**
 * @DI\Service("app.service.pagos360_sdk")
 */
class Pagos360Sdk
{
    private $apikey;

    private $em;

    /**
     * @param string $apiKey
     * @param EntityManager $em
     *
     * @DI\InjectParams({
     *     "apiKey" = @DI\Inject("%pagos360_api_key%"),
     *     "em" = @DI\Inject("doctrine.orm.entity_manager"),
     * })
     */
    public function __constructor(
        string $apiKey,
        EntityManager $em
    ) {
        $this->apikey = $apiKey;
        $this->em = $em;
    }

    /**
     * @param Student $student
     */
    public function generateInstallments(
        Student $student
    ): void {
        $monthNumber = (new DateTime())->format('m');
        $monthNumber++;

        $months = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];

        for ($i = intval($monthNumber); $i <= 12; $i++) {
            $date = date_create(sprintf(
                '%s-%s-%s',
                (new DateTime())->format('Y'),
                $i,
                15
            ));

            $installment = new Installment();
            $installment->setAmount($student->getPlan()->getAmount())
                ->setState(Installment::PENDING_STATE)
                ->setDescription('Cuota ' . $months[$i])
                ->setDueDate($date)
                ->setStudent($student);

            $this->em->persist($installment);

            $body = [
                'payment_request' => [
                    'description' => $installment->getDescription(),
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
                        'Authorization' => 'Bearer ' . $this->apikey
                    ]
                ]);

                $response = $client->request(
                    'POST',
                    'payment-request',
                    ['body' => json_encode($body)]
                );

                $jsonResponse = json_decode((string)$response->getBody());

                $installment->setTransactionId($jsonResponse->id);
                $installment->setCheckoutUrl($jsonResponse->checkout_url);
                $installment->setPdfUrl($jsonResponse->pdf_url);
            } catch (Exception | Throwable $e) {
                $this->em->remove($installment);

                throw new Exception('Ocurrió un error mientras se generaban las cuotas!');
            }
        }

        $student->setInstallmentsGenerated(true);
    }

    /**
     * @param Installment[] $installments
     * @return int
     *
     * @throws Exception
     */
    public function syncUpInstallments(
        array $installments
    ): int {
        $installmentsPaid = 0;
        $installmentsExpired = 0;
        foreach ($installments as $installment){
            try {
                $client = new HttpClient([
                    'base_uri' => 'https://sandboxapi.pagos360.com/',
                    'exceptions' => true,
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Bearer ' . $this->apikey
                    ]
                ]);

                $response = $client->request(
                    'GET',
                    'payment-request/' . $installment->getTransactionId()
                );

                $jsonResponse = json_decode((string)$response->getBody());

                if ($jsonResponse->state === 'paid') {
                    $installment->setState(Installment::PAID_STATE);
                    $installmentsPaid++;
                }

                if ($jsonResponse->state === 'expired') {
                    $installment->setState(Installment::EXPIRED_STATE);
                    $installmentsExpired++;
                }

            } catch (Exception | Throwable $e) {
                //TODO save exception
            }
        }

        return $installmentsPaid + $installmentsExpired;
    }
}
