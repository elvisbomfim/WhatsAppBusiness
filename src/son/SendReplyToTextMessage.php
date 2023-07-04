<?php

namespace Econsulte\WhatsappApiSdk\Son;

use GuzzleHttp\Client;
use Econsulte\WhatsappApiSdk\Contracts\WhatsAppServiceInterface;
use Econsulte\WhatsappApiSdk\Exception\WhatsAppBusinessException;

class SendReplyToTextMessage implements WhatsAppServiceInterface
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function sendReplyToTextMessage($message, $to, $message_id)
    {
        try {
            $response = $this->client->request('POST', 'messages', [
                'json' => [
                    'messaging_product' => 'whatsapp',
                    'recipient_type' => 'individual',
                    'to' => $to,
                    'context' => [
                        'message_id' => $message_id
                    ],
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
