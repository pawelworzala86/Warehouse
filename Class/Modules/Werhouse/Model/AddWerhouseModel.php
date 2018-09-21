<?php

namespace App\Modules\Werhouse\Model;

use App\Model;
use App\User;
use App\Company;
use App\Common;
use App\Werhouse;

class AddWerhouseModel extends Model
{

    private $params;

    public function getWerhouse($id = null)
    {
        if(!isset($id)){
            @$this->setParams([]);
            return $this->params;
        }
        return $this->db()->getRow('select sys_unique_id, name from werhouse where company_id=:company_id and sys_unique_id=:sys_unique_id', [
            'company_id' => Company::getId(),
            'sys_unique_id' => $id,
        ]);
    }

    public function setParams($data)
    {
        $this->params['sys_unique_id'] = $data['sys_unique_id'];
        $this->params['name'] = $data['name'];
        $this->params['user_id'] = User::getId();
        $this->params['company_id'] = Company::getId();
    }

    public function save()
    {
        $sql = 'insert into werhouse (name, company_id, user_id, sys_unique_id) values '
            . '(:name, :company_id, :user_id, :sys_unique_id)';
        if (!empty($this->params['sys_unique_id'])) {
            $sql = 'update werhouse set name=:name, user_id=:user_id '
                . 'where sys_unique_id=:sys_unique_id and company_id=:company_id';
        } else {
            unset($this->params['sys_unique_id']);
            $this->params['sys_unique_id'] = Common::getRandomChars();
        }
        $this->db()->execute($sql, $this->params);
        $werhouseId = $this->db()->insertId();
        if ($werhouseId === '0') {
            $werhouseId = $this->db()->getOne('select id from werhouse where sys_unique_id=?', $this->params['sys_unique_id']);
        }
        $this->db()->execute('update user set werhouse_id=? where id=?', [$werhouseId, User::getId()]);
        Werhouse::setId($werhouseId);

        $this->header('Location: /magazyny');
    }

}
