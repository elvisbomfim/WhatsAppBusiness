<?php

namespace Econsulte\WhatsappApiSdk\Son;

use GuzzleHttp\Client;
use Econsulte\WhatsappApiSdk\Contracts\WhatsAppServiceInterface;
use Econsulte\WhatsappApiSdk\Exception\WhatsAppBusinessException;

class SendTextMessage implements WhatsAppServiceInterface
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function sendTextMessage(string $message, $to)
    {
        try {
            $response = $this->client->request('POST', 'messages', [
                'json' => [
                    'messaging_product' => 'whatsapp',
                    'recipient_type' => 'individual',
                    'to' => $to,
                    'type' => 'text',
                    'text' => [
                        'preview_url' => false,
                        'body' => $message
                    ]
                ]
            ]);
            
            return json_decode($response->getBody()->getContents());
        } catch (WhatsAppBusinessException $e) {
            return $e->getMessage();
        }
    }
}
