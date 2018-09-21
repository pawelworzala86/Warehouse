<?php

namespace App\Types;

use App\Type;

class Contractor extends Type
{
    public $nip;
    public $mail;
    public $code;
    public $id;
    public $name;

    public function getNip()
    {
        return $this->nip;
    }

    public function setNip($nip)
    {
        $this->nip = $nip;
        return $this;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;
        return $this;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

}