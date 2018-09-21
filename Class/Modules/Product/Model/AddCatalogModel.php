<?php

namespace App\Modules\Product\Model;

use App\Model;
use App\User;
use App\Common;
use App\Company;

class AddCatalogModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function add()
    {
        $params['company_id'] = Company::getId();
        $params['sys_unique_id'] = isset($_POST['id']) ? $_POST['id'] : Common::getRandomChars();
        $params['name'] = $_POST['name'];
        $params['user_id'] = User::getId();
        $params['parent_id'] = $this->db()->getOne('select id from catalog where sys_unique_id=? and company_id=?', [
            $_POST['parent_id'], Company::getId()
        ]);
        $sql = 'insert into catalog (parent_id, company_id, sys_unique_id, name, user_id) values '
            . '(:parent_id, :company_id, :sys_unique_id, :name, :user_id)';
        if (isset($_POST['id'])) {
            $sql = 'update catalog set parent_id=:parent_id, user_id=:user_id, name=:name where sys_unique_id=:sys_unique_id and company_id=:company_id';
        } else {
            $params['sys_unique_id'] = Common::getRandomChars();
        }
        $this->db()->execute($sql, $params);
        $insertId = $this->db()->insertId();
        echo json_encode([
            'parent_id'=>$_POST['parent_id'],
            'id'=>$this->db()->getOne('select sys_unique_id from catalog where id=?', $insertId),
        ]);
        exit;
    }

}
