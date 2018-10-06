<?php

namespace App\Module\Contractor\Model;

use App\Model;
use App\Type\UUID;

class DebtorViewModel extends Model
{
    private $id;
    private $uuid;
    private $name;
    private $code;
    private $debt;

    function setDebt(float $debt = null): DebtorViewModel
    {
        $this->set('debt', $debt);
        $this->debt = $debt;
        return $this;
    }

    function getDebt(): ?float
    {
        return $this->debt;
    }

    function setCode(string $code = null): DebtorViewModel
    {
        $this->set('code', $code);
        $this->code = $code;
        return $this;
    }

    function getCode(): ?string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): DebtorViewModel
    {
        $this->set('name', $name);
        $this->name = $name;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): DebtorViewModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }

    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid): DebtorViewModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }
}