<?php

declare(strict_types=1);

namespace Econsulte\WhatsappApiSdk;

use GuzzleHttp\Client;

/**
 * @method SendTemplateMessage sendTemplateMessage($template, $to, array $components = [], $code)
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
 * @method UploadMidia uploadMidia($file)
 * @method SendMediaMessageByURL sendMediaMessageByURL(string $type,string $link)
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
   
}
