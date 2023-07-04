<?php

namespace Econsulte\WhatsappApiSdk\Son;

use GuzzleHttp\Client;
use Econsulte\WhatsappApiSdk\Contracts\WhatsAppServiceInterface;
use Econsulte\WhatsappApiSdk\Exception\WhatsAppBusinessException;

class SendTextMessageWithPreviewURL implements WhatsAppServiceInterface{

    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function sendTextMessageWithPreviewURL($message, $to)
    {
        try{
        $response = $this->client->request('POST', 'messages', [
            'json' => [
                "messaging_product" => "whatsapp",
                "to" => $to,
                "text" => [
                    "preview_url" => true,
                    "body" => $message
                ]
            ]
        ]);

        return json_decode($response->getBody()->getContents());
    } catch (WhatsAppBusinessException $e) {
        return $e->getMessage();
    }
    }
}