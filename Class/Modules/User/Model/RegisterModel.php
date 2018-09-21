<?php

namespace App\Modules\User\Model;

use App\Model;
use App\Common;

class RegisterModel extends Model
{

    const GROUP_ID_ADMIN = 1;

    public function register($data)
    {
        $userId = $this->db()->getOne('select id from user where mail=?', $data['mail']);
        if (isset($userId)) {
            return false;
        }
        $activateHash = Common::getRandomChars();
        $deleteHash = Common::getRandomChars();
        $this->db()->execute('insert into user (sys_unique_id, mail, password, activate_hash, delete_hash, company_id) values '
            . '(:sys_unique_id, :mail, :password, :activate_hash, :delete_hash, :company_id)', [
            'sys_unique_id' => Common::getRandomChars(),
            'mail' => $data['mail'],
            'password' => md5($data['password']),
            'activate_hash' => $activateHash,
            'delete_hash' => $deleteHash,
            'company_id' => $this->db()->getOne('select coalesce((select max(company_id) from user), 0)+1'),
        ]);
        $userId = $this->db()->insertId();
        $this->db()->execute('insert into user_group (user_id, group_id) values '
            . '(:user_id, :group_id)', [
            'user_id' => $userId,
            'group_id' => self::GROUP_ID_ADMIN,
        ]);
        return [
            'activateHash' => $activateHash,
            'deleteHash' => $deleteHash,
        ];
    }

}
