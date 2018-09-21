<?php

namespace App\Modules\Contractor\Model;

use App\Model;
use App\Company;
use App\Common;
use App\User;

class ContractorModel extends Model
{

    private $params;
    private $address;

    public function getAddress($id = null)
    {
        if(!isset($id)){
            @$this->setAddress([]);
            return $this->address;
        }
        return $this->db()->getRow('select sys_unique_id as id, firstname, surname, postcode, city, '
            . 'street, number, subnumber from address where id=:id', [
            'id' => $id,
        ]);
    }

    public function getContractor($id = null)
    {
        if(!isset($id)){
            @$this->setParams([]);
            return $this->params;
        }
        return $this->db()->getRow('select provider, recipient, nip, address_id, mail, fax, phone, code, sys_unique_id, name from contractor where company_id=:company_id and sys_unique_id=:sys_unique_id', [
            'company_id' => Company::getId(),
            'sys_unique_id' => $id,
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

    public function setParams($data)
    {
        $this->params['sys_unique_id'] = $data['id'];
        $this->params['name'] = $data['name'];
        $this->params['company_id'] = Company::getId();
        $this->params['user_id'] = User::getId();
        $this->params['code'] = $data['code'];
        $this->params['phone'] = $data['phone'];
        $this->params['fax'] = $data['fax'];
        $this->params['mail'] = $data['mail'];
        $this->params['nip'] = $data['nip'];
        $this->params['provider'] = (isset($data['provider']) && ($data['provider'] == 'true')) ? 1 : 0;
        $this->params['recipient'] = (isset($data['recipient']) && ($data['recipient'] == 'true')) ? 1 : 0;
    }

    private function checkAddressDifference($sysUniqueId)
    {
        if(!isset($sysUniqueId)){
            return true;
        }
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

        $sql = 'insert into contractor (recipient, provider, address_id, mail, fax, phone, code, sys_unique_id, name, company_id, nip, user_id) values '
            . '(:recipient, :provider, :address_id, :mail, :fax, :phone, :code, :sys_unique_id, :name, :company_id, :nip, :user_id)';
        if (!empty($this->params['sys_unique_id'])) {
            $sql = 'update contractor set recipient=:recipient, provider=:provider, address_id=:address_id, mail=:mail, '
                . 'fax=:fax, phone=:phone, code=:code, name=:name, '
                . 'nip=:nip, user_id=:user_id '
                . 'where sys_unique_id=:sys_unique_id and company_id=:company_id';
        } else {
            $this->params['sys_unique_id'] = Common::getRandomChars();
        }
        $this->db()->execute($sql, $this->params);

        $this->header('Location: /kontrahenci');
    }

}
