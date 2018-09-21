<?php

namespace App\Modules\User\Model;

use App\Model;

class ActivateModel extends Model
{

    public function activate($id)
    {
        $userId = $this->db()->getOne('select id from user where activate_hash=? and deleted is null', $id);
        if (!isset($userId)) {
            return false;
        }
        $this->db()->execute('update user set activate_hash=null, delete_hash=null where id=?', $userId);
        return $userId;
    }

}
