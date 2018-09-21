<?php

namespace App\Modules\User\Model;

use App\Model;

class DeactivateModel extends Model {

    public function deactivate($id) {
        $userId = $this->db()->getOne('select id from user where delete_hash=? and deleted is null', $id);
        if (!isset($userId)) {
            return false;
        }
        $this->db()->execute('update user set deleted=?, delete_hash=null where id=?', [time(), $userId]);
        return $userId;
    }

}
