<?php

namespace App\Modules\Production\Model;

use App\Model;
use App\User;
use App\Company;
use App\Common;
use DateTime;

class ProductionModel extends Model {

    private $params;

    public function getProduction($id = null) {
        if(!isset($id)){
            @$this->setParams(['date_start'=>date("d-m-Y"),'date_end'=>date("d-m-Y")]);
            $this->params['date_start'] = date("d-m-Y");
            $this->params['date_end'] = date("d-m-Y");
            return $this->params;
        }
        $production = $this->db()->getRow('select sys_unique_id, name, '
                . 'from_unixtime(date_start,\'%d-%m-%Y\') as date_start, '
                . 'from_unixtime(date_end,\'%d-%m-%Y\') as date_end '
                . 'from production where company_id=:company_id and sys_unique_id=:sys_unique_id', [
            'company_id' => Company::getId(),
            'sys_unique_id' => $id,
        ]);
        if (!isset($production['sys_unique_id'])) {
            $production = [
                'sys_unique_id' => null,
                'date_start' => date("d-m-Y"),
                'date_end' => date("d-m-Y"),
                'name' => '',
            ];
        }
        return $production;
    }

    public function setParams($data) {
        $this->params['sys_unique_id'] = $data['sys_unique_id'];
        $this->params['name'] = $data['name'];
        $this->params['user_id'] = User::getId();
        $this->params['company_id'] = Company::getId();
        $this->params['date_start'] = DateTime::createFromFormat('d-m-Y  G:i', $data['date_start'] . ' 00:00')->getTimestamp();
        $this->params['date_end'] = DateTime::createFromFormat('d-m-Y  G:i', $data['date_end'] . ' 00:00')->getTimestamp();
    }

    public function save() {
        $sql = 'insert into production (date_start, date_end, name, company_id, user_id, sys_unique_id) values '
                . '(:date_start, :date_end, :name, :company_id, :user_id, :sys_unique_id)';
        if (!empty($this->params['sys_unique_id'])) {
            $sql = 'update production set date_start=:date_start, date_end=:date_end, '
                    . 'name=:name, user_id=:user_id '
                    . 'where sys_unique_id=:sys_unique_id and company_id=:company_id';
        } else {
            unset($this->params['sys_unique_id']);
            $this->params['sys_unique_id'] = Common::getRandomChars();
        }
        $this->db()->execute($sql, $this->params);
        if (empty($this->params['id'])) {
            $this->params['id'] = $this->db()->insertId();
        }

        $this->header('Location: /produkcje');
    }

}
