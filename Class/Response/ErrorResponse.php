<?php

namespace App\Response;

class ErrorResponse extends Response
{

    public $messages = [];
    public $success;

    function __construct()
    {
        $this->setSuccess(false);
    }

    public function getSuccess(): bool
    {
        return $this->success;
    }

    public function setSuccess(bool $success): ErrorResponse
    {
        $this->success = $success;
        return $this;
    }

    public function getMessages(): array
    {
        return $this->messages;
    }

    public function setMessages(array $messages): ErrorResponse
    {
        $this->messages = $messages;
        return $this;
    }

}