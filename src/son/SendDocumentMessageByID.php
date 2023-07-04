<?php

namespace Econsulte\WhatsappApiSdk\Son;

use GuzzleHttp\Client;
use Econsulte\WhatsappApiSdk\Exception\WhatsAppBusinessException;
use Econsulte\WhatsappApiSdk\Contracts\WhatsAppServiceInterface;

class SendDocumentMessageByID implements WhatsAppServiceInterface
{

    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function SendDocumentMessageByID($to, $document_id, $caption, $filename)
    {
        try {

            $response = $this->client->request('POST', 'messages', [
                'json' => [
                    "messaging_product" => "whatsapp",
                    "recipient_type" => "individual",
                    "to" => $to,
                    "type" => "document",
                    "document" => [
                        "id" => $document_id,
                        "caption" => $caption,
                        "filename" => $filename
                    ]
                ]
            ]);

            return $response->getBody()->getContents();
        } catch (WhatsAppBusinessException $e) {
            return $e->getMessage();
        }
    }
}
