<?php

namespace Econsulte\WhatsappApiSdk\Son;

use GuzzleHttp\Client;
use Econsulte\WhatsappApiSdk\Contracts\WhatsAppServiceInterface;
use Econsulte\WhatsappApiSdk\Exception\WhatsAppBusinessException;


class SendAudioMessageByID implements WhatsAppServiceInterface
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function SendAudioMessageByID($to, $audio_id)
    {
        try {
            $response = $this->client->request('POST', 'messages', [
                'json' => [
                    "messaging_product" => "whatsapp",
                    "recipient_type" => "individual",
                    "to" => $to,
                    "type" => "audio",
                    "audio" => [
                        "id" => $audio_id
                    ]
                ]
            ]);

            return json_decode($response->getBody()->getContents());
        } catch (WhatsAppBusinessException $e) {
            return $e->getMessage();
        }
    }
}
