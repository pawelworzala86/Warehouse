<?php

namespace App\Module\Document\Model;

use App\Model;
use App\Type\UUID;

class DocumentNumberModel extends Model
{
    private $id;
    private $uuid;
    private $number;
    private $year;
    private $month;
    private $type;

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): DocumentNumberModel
    {
        $this->set('type', $type);
        $this->type = $type;
        return $this;
    }

    public function getMonth(): ?int
    {
        return $this->month;
    }

    public function setMonth(int $month = null): DocumentNumberModel
    {
        $this->set('month', $month);
        $this->month = $month;
        return $this;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function setYear(int $year): DocumentNumberModel
    {
        $this->set('year', $year);
        $this->year = $year;
        return $this;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setNumber(int $number): DocumentNumberModel
    {
        $this->set('number', $number);
        $this->number = $number;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id = null): DocumentNumberModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }

    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid): DocumentNumberModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }
}