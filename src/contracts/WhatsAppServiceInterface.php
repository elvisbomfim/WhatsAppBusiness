<?php 


namespace Econsulte\WhatsappApiSdk\Contracts;

use GuzzleHttp\Client;
use Econsulte\WhatsappApiSdk\Exception\WhatsAppBusinessException;

interface WhatsAppServiceInterface
{
    public function __construct(Client $client);
   
}