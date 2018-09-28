<?php

namespace App\Type;

use App\Type;

class Mail extends Type
{
    private $mail;

    function setMail(string $mail): Mail
    {
        $this->mail = $mail;
        return $this;
    }

    function getMail(): string
    {
        return $this->mail;
    }
}