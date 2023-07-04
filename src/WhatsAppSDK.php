<?php

declare(strict_types=1);

namespace Econsulte\WhatsappApiSdk;

use GuzzleHttp\Client;

/**
 * @method SendTemplateMessage sendTemplateMessage($template, $to, $components = [], $code)
 * @method SendTextMessage sendTextMessage()
 * @method SendReplyToTextMessage sendReplyToTextMessage($message, $to, $message_id)
 * @method SendTextMessageWithPreviewURL sendTextMessageWithPreviewURL()
 * @method SendReplyWithReactionMessage sendReplyWithReactionMessage($emoji, $to, $message_id)
 * @method SendImageMessageByID sendImageMessageByID($to, $media_id)
 * @method SendReplyToImageMessageByID sendReplyToImageMessageByID($to, $prev_msg_id, $image_id)
 * @method SendAudioMessageByID sendAudioMessageByID($to, $audio_id)
 * @method SendDocumentMessageByID sendDocumentMessageByID($to, $document_id, $caption, $filename)
 * @method MarkMessageAsRead markMessageAsRead()
 * @method Verify verify()
 * @method RetrivedMedia retrivedMedia($media_id)
 * @method DownloadMedia downloadMedia($media_id)
 * @method UploadImage uploadImage($file)
 */
class WhatsAppSDK
{

    private $client;
    private $phone_number_id;
    private $version;


    public function __construct(string $token, string $phone_number_id, string $version = 'v15.0')
    {

        $this->version = $version;
        $this->phone_number_id = $phone_number_id;

        $this->client = new Client([
            'http_errors' => false,
            'base_uri' => "https://graph.facebook.com/{$version}/$phone_number_id/",
            'headers' => [
                'Authorization' => "Bearer {$token}",
                'Content-Type' => 'application/json'
            ]
        ]);
    }


    public function __call($method, $args)
    {
        $className = __NAMESPACE__ . '\\Son\\' . ucfirst($method);
        
        if (class_exists($className)) {
           
            $whatsappMethods = new $className($this->client, $this->version, $this->phone_number_id);
            return $whatsappMethods->$method(...$args);
        }
        throw new \BadMethodCallException("Method {$method} does not exist.");
    }


    // public function sendTemplateMessage($template, $to, $components = [], $code = 'pt_BR')
    // {

    //     $response = $this->client->request('POST', 'messages', [
    //         'json' => [
    //             'messaging_product' => 'whatsapp',
    //             'to' => $to,
    //             'type' => 'template',
    //             'template' => [
    //                 'name' => $template,
    //                 'language' => [
    //                     'code' => $code
    //                 ],
    //                 "components" => $components
    //             ],

    //         ]
    //     ]);

    //     return $response->getBody()->getContents();
    // }


    // public function sendMessage(string $message, $to)
    // {
    //     $response = $this->client->request('POST', 'messages', [
    //         'json' => [
    //             'messaging_product' => 'whatsapp',
    //             'recipient_type' => 'individual',
    //             'to' => $to,
    //             'type' => 'text',
    //             'text' => [
    //                 'preview_url' => false,
    //                 'body' => $message
    //             ]
    //         ]
    //     ]);


    //     return $response->getBody()->getContents();
    // }

    // public function replyMessage(string $message, $to, $message_id)
    // {
    //     $response = $this->client->request('POST', 'messages', [
    //         'json' => [
    //             'messaging_product' => 'whatsapp',
    //             'recipient_type' => 'individual',
    //             'to' => $to,
    //             'context' => [
    //                 'message_id' => $message_id
    //             ],
    //             'type' => 'text',
    //             'text' => [
    //                 'preview_url' => false,
    //                 'body' => $message
    //             ]
    //         ]
    //     ]);

    //     return $response->getBody()->getContents();
    // }

    // public function sendTextMessageWithPreviewURL($message, $to)
    // {
    //     $response = $this->client->request('POST', 'messages', [
    //         'json' => [
    //             "messaging_product" => "whatsapp",
    //             "to" => $to,
    //             "text" => [
    //                 "preview_url" => true,
    //                 "body" => $message
    //             ]
    //         ]
    //     ]);

    //     return $response->getBody()->getContents();
    // }

    // public function SendReplyWithReactionMessage($emoji, $to, $message_id)
    // {
    //     $response = $this->client->request('POST', 'messages', [
    //         'json' => [
    //             "messaging_product" => "whatsapp",
    //             "recipient_type" => "individual",
    //             "to" => $to,
    //             "type" => "reaction",
    //             "reaction" => [
    //                 "message_id" => $message_id,
    //                 "emoji" => $emoji
    //             ]
    //         ]
    //     ]);

    //     return $response->getBody()->getContents();
    // }

    // public function SendImageMessageByID($to, $media_id)
    // {
    //     $response = $this->client->request('POST', 'messages', [
    //         'json' => [
    //             "messaging_product" => "whatsapp",
    //             "recipient_type" => "individual",
    //             "to" => $to,
    //             "type" => "image",
    //             "image" => [
    //                 "id" => $media_id
    //             ]
    //         ]
    //     ]);

    //     return $response->getBody()->getContents();
    // }

    // public function SendReplyToImageMessageByID($to, $prev_msg_id, $image_id)
    // {
    //     $response = $this->client->request('POST', 'messages', [
    //         'json' => [
    //             "messaging_product" => "whatsapp",
    //             "recipient_type" => "individual",
    //             "to" => $to,
    //             "context" => [
    //                 "message_id" => $prev_msg_id
    //             ],
    //             "type" => "image",
    //             "image" => [
    //                 "id" => $image_id
    //             ]
    //         ]
    //     ]);

    //     return $response->getBody()->getContents();
    // }

    // public function SendAudioMessageByID($to, $audio_id){
    //     $response = $this->client->request('POST', 'messages', [
    //         'json' => [
    //             "messaging_product" => "whatsapp",
    //             "recipient_type" => "individual",
    //             "to" => $to,
    //             "type" => "audio",
    //             "audio" => [
    //                 "id" => $audio_id
    //             ]
    //         ]
    //     ]);

    //     return $response->getBody()->getContents();
    // }


    // public function SendDocumentMessageByID($to, $document_id, $caption, $filename){
    //     $response = $this->client->request('POST', 'messages', [
    //         'json' => [
    //             "messaging_product" => "whatsapp",
    //             "recipient_type" => "individual",
    //             "to" => $to,
    //             "type" => "document",
    //             "document" => [
    //                 "id" => $document_id,
    //                 "caption" => $caption,
    //                 "filename" => $filename
    //             ]
    //         ]
    //     ]);

    //     return $response->getBody()->getContents();
    // }
    

    // public function markMessageAsRead($message_id)
    // {
    //     $response = $this->client->request('POST', 'messages', [
    //         'json' => [
    //             'messaging_product' => 'whatsapp',
    //             'status' => 'read',
    //             'message_id' => $message_id
    //         ]
    //     ]);

    //     return $response->getBody()->getContents();
    // }


    // public function verify($token)
    // {
    //     $response = $this->client->get('/webhook', [
    //         'query' => [
    //             'hub.mode' => 'subscribe',
    //             'hub.verify_token' => $token,
    //             'hub.challenge'
    //         ]
    //     ]);

    //     if ($response->getStatusCode() == 200 && $response->getHeaderLine('hub.mode') === 'subscribe' && $response->getHeaderLine('hub.verify_token') === $token) {
    //         echo "WEBHOOK_VERIFIED";
    //     } else {
    //         echo "Forbidden";
    //     }
    // }


    // public function retrivedMedia($media_id)
    // {
    //     $response = $this->client->get("https://graph.facebook.com/{$this->version}/{$media_id}?phone_number_id=103540532647220");

    //     $mediaJson = json_decode($response->getBody()->getContents());

    //     $mediaFile =  $this->client->get($mediaJson->url);

    //     return ['file' => $mediaFile->getBody()->getContents(), 'media' => $mediaJson];
    // }

    // public function downloadMedia($media_id)
    // {
    //     $response = $this->client->get("https://graph.facebook.com/{$this->version}/{$media_id}");

    //     $mediaJson = json_decode($response->getBody()->getContents());


    //     $mediaFile =  $this->client->get($mediaJson->url);



    //     return ['file' => $mediaFile->getBody()->getContents(), 'media' => $mediaJson];
    // }
}
