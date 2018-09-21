<?php

namespace App\Modules\Setting\Model;

use App\Model;
use App\Company;
use App\Common;
use App\User;

class SettingAddressModel extends Model
{

    private $params;
    private $address;

    public function getAddress($id = null)
    {
        return $this->db()->getRow('select sys_unique_id as id, firstname, surname, postcode, city, '
            . 'street, number, subnumber from address where id=:id', [
            'id' => $id,
        ]);
    }

    public function setAddress($data)
    {
        $this->address['sys_unique_id'] = $data['id'];
        $this->address['firstname'] = $data['firstname'];
        $this->address['surname'] = $data['surname'];
        $this->address['postcode'] = $data['postcode'];
        $this->address['city'] = $data['city'];
        $this->address['street'] = $data['street'];
        $this->address['number'] = $data['number'];
        $this->address['subnumber'] = $data['subnumber'];
    }

    private function checkAddressDifference($sysUniqueId)
    {
        $address = $this->db()->getRow('select * from address where sys_unique_id=?', $sysUniqueId);
        $different = false;
        if (
            ($this->address['firstname'] != $address['firstname']) ||
            ($this->address['surname'] != $address['surname']) ||
            ($this->address['postcode'] != $address['postcode']) ||
            ($this->address['city'] != $address['city']) ||
            ($this->address['street'] != $address['street']) ||
            ($this->address['number'] != $address['number']) ||
            ($this->address['subnumber'] != $address['subnumber'])
        ) {
            $different = true;
        }
        return $different;
    }

    public function save()
    {
        if ($this->checkAddressDifference($this->address['sys_unique_id'])) {
            $sql = 'insert into address (subnumber, number, street, city, '
                . 'postcode, surname, firstname, sys_unique_id) values '
                . '(:subnumber, :number, :street, :city, :postcode, '
                . ':surname, :firstname, :sys_unique_id)';
            $this->address['sys_unique_id'] = Common::getRandomChars();
            $this->db()->execute($sql, $this->address);
            $this->params['address_id'] = $this->db()->insertId();
        } else {
            $this->params['address_id'] = $this->db()->getOne('select id from address where sys_unique_id=?', $this->address['sys_unique_id']);
        }

        $this->db()->execute('update user set address_id=? where id=?', [$this->params['address_id'], User::getId()]);

        header('Location: /ustawienia');
    }

}
