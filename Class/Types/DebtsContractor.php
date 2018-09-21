<?php

namespace App\Types;

use App\Type;

class DebtsContractor extends Type
{
    public $nip;
    public $mail;
    public $code;
    public $id;
    public $name;
    public $debt;
    public $documents;

    public function getDocuments():DebtsDocuments
    {
        return $this->documents;
    }

    public function setDocuments(DebtsDocuments $documents)
    {
        $this->documents = $documents;
        return $this;
    }

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

    public function getDebt()
    {
        return $this->debt;
    }

    public function setDebt($debt)
    {
        $this->debt = $debt;
        return $this;
    }

}