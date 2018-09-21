<?php

namespace App\Modules\Werhouse\Controller;

use App\Model;
use App\User;
use App\Werhouse;

class WerhouseSwitch extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function __invoke($id)
    {
        $werhouseId = $this->db()->getOne('select id from werhouse where sys_unique_id=?', $id);
        $this->db()->execute('update user set werhouse_id=? where id=?', [$werhouseId, User::getId()]);
        Werhouse::setId($werhouseId);

        exit;
    }

}
