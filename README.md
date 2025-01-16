## INSTALAÇÃO

```````
composer require econsulte/whatsapp-api-sdk
```````

### INÍCIO
Creat a new object BoletoSDK with token
```````
use Econsulte\whatsappApiSDK\whatsappSDK;
$api = new WhatsAppSDK('################################', 'phone_number_id');
```````

### ENVIO DE MENSAGEM
message + whatsapp_number 
```````
$app->sendTextMessage('hello world', "55###########")
```````

### ENVIO DE MENSAGEM TEMPLATE
template_name + whatsapp_number + parameters + lang
```````
$app->sendTemplateMessage('template_name', "55###########", [[
        "type" => "body",
        "parameters" => [
            [
                'type' => 'text',
                'text' => $var1,
            ],
            [
                'type' => 'text',
                'text' => $var2
            ]
        ]
    ]])
```````


