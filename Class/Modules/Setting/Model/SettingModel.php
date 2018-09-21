<?php

namespace App\Modules\Setting\Model;

use App\Model;
use App\Company;
use App\Common;
use App\User;

class SettingModel extends Model
{

    private $params;
    private $address;

    public function getAddressId(): ?int
    {
        return $this->db()->getOne('select address_id from user where id=?', User::getId());
    }

    public function getUser(): array
    {
        return $this->db()->getRow('select currency from user where id=?', User::getId());
    }

}
