<?php

namespace Econsulte\WhatsappApiSdk\Son;

use GuzzleHttp\Client;
use Econsulte\WhatsappApiSdk\Contracts\WhatsAppServiceInterface;
use Econsulte\WhatsappApiSdk\Exception\WhatsAppBusinessException;

class MarkMessageAsRead implements WhatsAppServiceInterface
{
    private $client;


    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function markMessageAsRead($message_id)
    {
        try {
            $response = $this->client->request('POST', 'messages', [
                'json' => [
                    'messaging_product' => 'whatsapp',
                    'status' => 'read',
                    'message_id' => $message_id
                ]
            ]);

            return json_decode($response->getBody()->getContents());
        } catch (WhatsAppBusinessException $e) {
            return $e->getMessage();
        }
    }
}
