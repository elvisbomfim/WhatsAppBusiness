<?php

namespace Econsulte\WhatsappApiSdk\Son;

use GuzzleHttp\Client;
use Econsulte\WhatsappApiSdk\Contracts\WhatsAppServiceInterface;
use Econsulte\WhatsappApiSdk\Exception\WhatsAppBusinessException;

class SendReplyToImageMessageByID implements WhatsAppServiceInterface
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function sendReplyToImageMessageByID($to, $prev_msg_id, $image_id)
    {
        try {
            $response = $this->client->request('POST', 'messages', [
                'json' => [
                    "messaging_product" => "whatsapp",
                    "recipient_type" => "individual",
                    "to" => $to,
                    "context" => [
                        "message_id" => $prev_msg_id
                    ],
                    "type" => "image",
                    "image" => [
                        "id" => $image_id
                    ]
                ]
            ]);

            return $response->getBody()->getContents();

            return json_decode($response->getBody()->getContents());
        } catch (WhatsAppBusinessException $e) {
            return $e->getMessage();
        }
    }
}
