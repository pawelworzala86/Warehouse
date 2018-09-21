<?php

namespace App\Modules\Setting\Model;

use App\Model;
use App\User;

class SettingOtherModel extends Model
{

    private $params;
    private $other;

    public function getOther():array
    {
        return $this->db()->getRow('select currency, sys_unique_id as id from user where id=:id', [
            'id' => User::getId(),
        ]);
    }

    public function setOther($data)
    {
        $this->other['id'] = User::getId();
        $this->other['currency'] = $data['currency'];
    }

    public function save()
    {
        if (isset($this->other['id'])&&!empty($this->other['id'])) {
            $this->db()->execute('update user set currency=:currency where id=:id', $this->other);
        }

        header('Location: /ustawienia');
    }

}
