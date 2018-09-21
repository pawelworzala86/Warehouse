<?php

namespace App\Modules\Worker\Model;

use App\Model;
use App\User;
use App\Company;
use App\Common;

class WorkerModel extends Model {

    private $params;

    public function getWorker($id = null) {
        return $this->db()->getRow('select occupation, sys_unique_id, name, sollary from worker where company_id=:company_id and sys_unique_id=:sys_unique_id', [
                    'company_id' => Company::getId(),
                    'sys_unique_id' => $id,
        ]);
    }

    public function setParams($data) {
        $this->params['sys_unique_id'] = $data['id'];
        $this->params['name'] = $data['name'];
        $this->params['sollary'] = $data['sollary'];
        $this->params['user_id'] = User::getId();
        $this->params['company_id'] = Company::getId();
        $this->params['occupation'] = $data['occupation'];
    }

    public function save() {
        $sql = 'insert into worker (name, company_id, user_id, sys_unique_id, sollary, occupation) values '
                . '(:name, :company_id, :user_id, :sys_unique_id, :sollary, :occupation)';
        if (!empty($this->params['sys_unique_id'])) {
            $sql = 'update worker set occupation=:occupation, name=:name, user_id=:user_id, '
                    . 'sollary=:sollary '
                    . 'where sys_unique_id=:sys_unique_id and company_id=:company_id';
        } else {
            unset($this->params['sys_unique_id']);
            $this->params['sys_unique_id'] = Common::getRandomChars();
        }
        $this->db()->execute($sql, $this->params);
        if (empty($this->params['id'])) {
            $this->params['id'] = $this->db()->insertId();
        }

        header('Location: /pracownicy');
    }

}
