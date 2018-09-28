<?php

namespace App\Module\User\Request;

use App\Request\Request;
use App\Type\UUID;

class ConfirmRegistrationRequest extends Request
{

    private $code;
    private $confirmationCode;

    public function getCode(): UUID
    {
        return $this->code;
    }

    public function setCode(UUID $code): ConfirmRegistrationRequest
    {
        $this->code = $code;
        return $this;
    }

    public function getConfirmationCode(): UUID
    {
        return $this->confirmationCode;
    }

    public function setConfirmationCode(UUID $confirmationCode): ConfirmRegistrationRequest
    {
        $this->confirmationCode = $confirmationCode;
        return $this;
    }

}