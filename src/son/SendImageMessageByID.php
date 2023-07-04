<?php

namespace Econsulte\WhatsappApiSdk\Son;

use GuzzleHttp\Client;
use Econsulte\WhatsappApiSdk\Exception\WhatsAppBusinessException;
use Econsulte\WhatsappApiSdk\Contracts\WhatsAppServiceInterface;

class SendImageMessageByID implements WhatsAppServiceInterface
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function sendImageMessageByID($to, $media_id)
    {
        try {
            $response = $this->client->request('POST', 'messages', [
                'json' => [
                    "messaging_product" => "whatsapp",
                    "recipient_type" => "individual",
                    "to" => $to,
                    "type" => "image",
                    "image" => [
                        "id" => $media_id
                    ]
                ]
            ]);

            return json_decode($response->getBody()->getContents());
        } catch (WhatsAppBusinessException $e) {
            return $e->getMessage();
        }
    }
}
