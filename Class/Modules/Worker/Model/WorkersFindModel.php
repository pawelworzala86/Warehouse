<?php

namespace App\Modules\Worker\Model;

use App\Model;
use App\Company;

class WorkersFindModel extends Model {

    public function getWorkers($search = '') {
        $where = '';
        if(!empty($search)){
            $where .= ' and name like \'%'.$search.'%\' ';
        }
        $result = [];
        $workers = $this->db()->getAll('select * from worker where company_id=? and deleted is null '.$where.' limit 5', Company::getId());
        foreach($workers as $worker){
            $result[] = [
                'id'=>$worker['sys_unique_id'],
                'name'=>$worker['name'],
            ];
        }
        return $result;
    }

}
