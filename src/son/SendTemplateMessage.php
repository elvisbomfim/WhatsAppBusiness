<?php

namespace Econsulte\WhatsappApiSdk\Son;

use Econsulte\WhatsappApiSdk\Exception\WhatsAppBusinessException;
use Econsulte\WhatsappApiSdk\Contracts\WhatsAppServiceInterface;

use GuzzleHttp\Client;

class SendTemplateMessage implements WhatsAppServiceInterface
{
    private $client;


    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function sendTemplateMessage($template, $to, $components = [], $code = 'pt_BR')
    {
        try {
            $response = $this->client->request('POST', 'messages', [
                'json' => [
                    'messaging_product' => 'whatsapp',
                    'to' => $to,
                    'type' => 'template',
                    'template' => [
                        'name' => $template,
                        'language' => [
                            'code' => $code
                        ],
                        "components" => $components
                    ],
                ]
            ]);

            return json_decode($response->getBody()->getContents());
        } catch (WhatsAppBusinessException $e) {
            return $e->getMessage();
        }
    }
}
