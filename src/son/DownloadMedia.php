<?php

namespace Econsulte\WhatsappApiSdk\Son;

use GuzzleHttp\Client;
use Econsulte\WhatsappApiSdk\Contracts\WhatsAppServiceClientVersionInterface;
use Econsulte\WhatsappApiSdk\Exception\WhatsAppBusinessException;

class DownloadMedia implements WhatsAppServiceClientVersionInterface
{
    protected $client;
    private $version;
    public function __construct(Client $client, $version)
    {
        $this->client = $client;
        $this->version = $version;
    }

    public function downloadMedia($media_id)
    {
        try {
            $response = $this->client->get("https://graph.facebook.com/{$this->version}/{$media_id}");

            $mediaJson = json_decode($response->getBody()->getContents());

            $mediaFile = $this->client->get($mediaJson->url);

            return ['file' => $mediaFile->getBody()->getContents(), 'media' => $mediaJson];
        } catch (WhatsAppBusinessException $e) {
            return $e->getMessage();
        }
    }
}
