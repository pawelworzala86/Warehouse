<?php

namespace App\Types;

use App\Type;

class DebtsDocument extends Type
{
    public $payed;
    public $number;
    public $date_add;
    public $date_pay;
    public $debt;

    public function getPayed()
    {
        return $this->payed;
    }

    public function setPayed($payed)
    {
        $this->payed = $payed;
        return $this;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    public function getDateAdd()
    {
        return $this->date_add;
    }

    public function setDateAdd($date_add)
    {
        $this->date_add = $date_add;
        return $this;
    }

    public function getDatePay()
    {
        return $this->date_pay;
    }

    public function setDatePay($date_pay)
    {
        $this->date_pay = $date_pay;
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