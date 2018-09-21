<?php

namespace App\Modules\User\Model;

use App\Model;
use App\User;
use App\Company;
use App\Werhouse;

class LoginModel extends Model
{

    public function login($data)
    {
        $user = $this->db()->getRow('select * from user where mail=?', $data['mail']);
        if ($user['password'] == md5($data['password'])) {
            User::setId($user['id']);
            User::setSuperAdmin($user['super_admin']);
            User::setCurrency($user['currency']);
            Company::setId($user['company_id']);
            Werhouse::setId($user['werhouse_id']);
            return true;
        }
        return false;
    }

    public function checkActive($data)
    {
        $activateHash = $this->db()->getOne('select activate_hash from user where mail=?', $data['mail']);
        if (isset($activateHash)) {
            return true;
        }
        return false;
    }

}
