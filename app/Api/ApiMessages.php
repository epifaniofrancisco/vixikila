<?php

namespace App\APi;

class ApiMessages{ //class criada para retornar erros
    private $message=[];
    public function __construct(string $message, array $data=[])
    {
        $this->message['message']=$message;
        $this->message['errors']=$data;
    }

    public function getMessage()
    {
        return $this->message;
    }

}
