<?php

namespace App\Response;

class SuccessResponse extends Response
{

    public $success;

    function __construct()
    {
        $this->setSuccess(true);
    }

    public function getSuccess(): bool
    {
        return $this->success;
    }

    public function setSuccess(bool $success): SuccessResponse
    {
        $this->success = $success;
        return $this;
    }

}