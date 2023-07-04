<?php

namespace Econsulte\WhatsappApiSdk\Exception;

use Exception;


class WhatsAppBusinessException extends Exception
{
    protected $error;

    public function __construct($error)
    {
        $this->error = $error;
        $message = isset($error['message']) ? $error['message'] : 'Rate limit hit';
        $code = isset($error['code']) ? $error['code'] : 0;
        parent::__construct($message, $code);
    }

    public function getError()
    {
        return $this->error;
    }

    
   
}
