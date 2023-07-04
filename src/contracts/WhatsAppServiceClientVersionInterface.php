<?php 


namespace Econsulte\WhatsappApiSdk\Contracts;

use GuzzleHttp\Client;

interface WhatsAppServiceClientVersionInterface
{
    public function __construct(Client $client, string $version);

}