<?php

namespace App\Module\User\Model;

use App\Model;
use App\Type\EncodedPassword;
use App\Type\Mail;
use App\Type\UUID;

class UserRegisterModel extends Model
{
    private $mail;
    private $password;
    private $confirmationCode;
    private $uuid;

    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid): UserRegisterModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }

    public function getConfirmationCode(): UUID
    {
        return $this->confirmationCode;
    }

    public function setConfirmationCode(UUID $confirmationCode): UserRegisterModel
    {
        $this->set('confirmation_code', hex2bin($confirmationCode));
        $this->confirmationCode = $confirmationCode;
        return $this;
    }

    public function getMail(): Mail
    {
        return $this->mail;
    }

    public function setMail(Mail $mail): UserRegisterModel
    {
        $this->set('mail', $mail);
        $this->mail = $mail;
        return $this;
    }

    public function getPassword(): EncodedPassword
    {
        return $this->password;
    }

    public function setPassword(EncodedPassword $password): UserRegisterModel
    {
        $this->set('password', $password);
        $this->password = $password;
        return $this;
    }


}