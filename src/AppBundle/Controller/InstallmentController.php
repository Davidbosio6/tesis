<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Installment;
use AppBundle\Entity\Student;
use DateTime;
use Doctrine\DBAL\Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\Client as HttpClient;
use Throwable;

/**
 * Class YearController.
 *
 * @Route("/installment")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class InstallmentController extends AbstractController
{
    /**
     * @Route("/generate/{id}", name="installment_generate")
     *
     * @param Student $student
     *
     * @return Response
     */
    public function generateAction(
        Student $student
    ): Response {
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
                $this->addFlash('error', 'Ocurrió un error mientras se generaban las cuotas!');

                return $this->redirectToRoute(
                    'student_detail',
                    ['id' => $student->getId()]
                );
            } catch (Throwable $e) {
                $this->addFlash('error', 'Ocurrió un error mientras se generaban las cuotas!');

                return $this->redirectToRoute(
                    'student_detail',
                    ['id' => $student->getId()]
                );
            }

            $this->getEntityManager()->flush();
        }

        $this->addFlash('success', 'Cuotas generadas con éxito!');

        return $this->redirectToRoute(
            'student_detail',
            ['id' => $student->getId()]
        );
    }
}
