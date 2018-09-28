<?php

namespace App\Module\User\Request;

use App\Request\Request;
use App\Type\Mail;
use App\Type\Password;

class RegisterUserRequest extends Request
{

    private $mail;
    private $password;

    public function getMail(): Mail
    {
        return $this->mail;
    }

    public function setMail(Mail $mail)
    {
        $this->mail = $mail;
        return $this;
    }

    public function getPassword(): Password
    {
        return $this->password;
    }

    public function setPassword(Password $password)
    {
        $this->password = $password;
        return $this;
    }

}