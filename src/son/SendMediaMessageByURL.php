<?php

namespace Econsulte\WhatsappApiSdk\Son;

use GuzzleHttp\Client;
use Econsulte\WhatsappApiSdk\Contracts\WhatsAppServiceInterface;
use Econsulte\WhatsappApiSdk\Exception\WhatsAppBusinessException;

class SendMediaMessageByURL implements WhatsAppServiceInterface
{

    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Envie uma mensagem de mídia por URL.
     *
     * @param string $type O tipo de mídia a ser enviada.
     * @param string $link O link da mídia a ser enviada.
     * @return mixed Os detalhes da resposta da API ou uma mensagem de erro em caso de exceção.
     * @throws WhatsAppBusinessException Se ocorrer um erro ao enviar a mensagem.
     */
    public function sendMediaMessageByURL(string $to, string $type, string $url, $caption = null)
    {
        $config = [];

        $config = [
            "link" => $url
        ];

        if (!empty($caption)) :
            $config['caption'] = $caption;
        endif;

        try {
            $response = $this->client->request('POST', 'messages', [
                'json' => [
                    "messaging_product" => "whatsapp",
                    "recipient_type" =>  "individual",
                    "to" => $to,
                    "type" => $type,
                    $type => $config
                ]
            ]);

            return json_decode($response->getBody()->getContents());
        } catch (WhatsAppBusinessException $e) {
            return $e->getMessage();
        }
    }
}
