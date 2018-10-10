<?php

namespace App\Module\Cash\Model;

use App\Model;

class CashViewModel extends Model
{
    private $addedBy;
    private $ballance;

    public function getBallance(): ?float
    {
        return $this->ballance;
    }

    public function setBallance(float $ballance): CashViewModel
    {
        $this->set('ballance', $ballance);
        $this->ballance = $ballance;
        return $this;
    }

    public function getAddedBy(): int
    {
        return $this->addedBy;
    }

    public function setAddedBy(int $addedBy): CashViewModel
    {
        $this->set('added_by', $addedBy);
        $this->addedBy = $addedBy;
        return $this;
    }
}