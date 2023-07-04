<?php

namespace Econsulte\WhatsappApiSdk\Son;

use GuzzleHttp\Client;
use Econsulte\WhatsappApiSdk\Contracts\WhatsAppServiceInterface;
use Econsulte\WhatsappApiSdk\Exception\WhatsAppBusinessException;

class UploadImage implements WhatsAppServiceInterface{

    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function uploadImage($file)
    {
        try{
        $response = $this->client->request('POST', 'media', [
            'json' => [
                "messaging_product" => "whatsapp",
                "file" => $file,                
            ]
        ]);

        return json_decode($response->getBody()->getContents());
    } catch (WhatsAppBusinessException $e) {
        return $e->getMessage();
    }
    }
}