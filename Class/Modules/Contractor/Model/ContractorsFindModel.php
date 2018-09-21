<?php

namespace App\Modules\Contractor\Model;

use App\Model;
use App\Company;

class ContractorsFindModel extends Model {

    public function getContractors($search = '', $provider=false) {
        $where = '';
        if(!empty($search)){
            $where .= ' and name like \'%'.$search.'%\' ';
        }
        if($provider){
            $where .= ' and provider=1 ';
        }
        $result = [];
        $products = $this->db()->getAll('select * from contractor where company_id=? and deleted is null '.$where.' limit 5', Company::getId());
        foreach($products as $product){
            $result[] = [
                'id'=>$product['sys_unique_id'],
                'name'=>$product['name'],
            ];
        }
        return $result;
    }

}
