<?php

namespace App\Modules\Document\Model;

use App\Model;
use App\User;
use App\Company;

class DocumentModel extends Model {

    public function delete($id) {
        return $this->db()->execute('update document set deleted=:deleted, user_id=:user_id where company_id=:company_id and sys_unique_id=:id', [
                    'user_id' => User::getId(),
                    'company_id' => Company::getId(),
                    'id' => $id,
                    'deleted' => time(),
        ]);
    }

}
