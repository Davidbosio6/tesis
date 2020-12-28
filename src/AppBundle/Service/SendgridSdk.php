<?php

namespace AppBundle\Service;

use AppBundle\Entity\Advisor;
use AppBundle\Entity\Student;
use Exception;
use JMS\DiExtraBundle\Annotation as DI;
use GuzzleHttp\Client as HttpClient;

/**
 * @DI\Service("app.service.sendgrid_sdk")
 */
class SendgridSdk
{
    private $apikey;

    /**
     * @param string $apiKey
     *
     * @DI\InjectParams({
     *     "apiKey" = @DI\Inject("%sendgrid_api_key%")
     *
     *     })
     */
    public function __constructor(
        string $apiKey
    ) {
        $this->apikey = $apiKey;
    }


    public function sendWelcomeEmail(
        Student $student,
        Advisor $advisor
    ) {
        $dynamicTemplateData = [
            'advisor_name' => $advisor->getFullName(),
            'student_name' => $student->getFullName(),
            'id_number' => $student->getIdNumber(),
            'plan_name' => $student->getPlan()->getName(),
            'code_id' => $student->getCodeId(),
        ];

        $this->send(
            'd-e6121572180d4f0ba404514f9450dbdf',
            $dynamicTemplateData,
            $advisor->getEmail()
        );
    }

    /**
     * @param string $templateId
     * @param array $dynamicTemplateData
     * @param string $toEmail
     * @throws Exception
     */
    private function send(
        string $templateId,
        array $dynamicTemplateData,
        string $toEmail
    ) {
        $body = [
            'from' => [
                "email" => "notificaciones.semillitas@gmail.com"
            ],
            'personalizations' => [
                [
                    "to" => [
                        ["email" => $toEmail]
                    ],
                    'dynamic_template_data' => $dynamicTemplateData
                ]
            ],
            "template_id" => $templateId
        ];

        $client = new HttpClient([
            'base_uri' => 'https://api.sendgrid.com/v3/mail/',
            'exceptions' => true,
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->apikey
            ]
        ]);

        $response = $client->request(
            'POST',
            'send',
            ['body' => json_encode($body)]
        );
    }

}
