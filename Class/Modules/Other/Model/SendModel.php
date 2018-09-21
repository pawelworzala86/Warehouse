<?php

namespace App\Modules\Other\Model;

use App\Model;
use App\Company;
use App\Common;

class SendModel extends Model {

    public function getProduct($id = null) {
        return $this->db()->getRow('select id, name from product where company_id=:company_id and sys_unique_id=:id', [
                    'company_id' => Company::getId(),
                    'id' => $id,
        ]);
    }

    public function addAuction($id, $outerid, $auction) {
        $params = [
            'product_id' => $id,
            'outerid' => $outerid,
            'auction' => $auction,
            'sys_unique_id' => Common::getRandomChars(),
            'added' => time(),
        ];
        $this->db()->execute('insert into product_auction (product_id, outerid, auction, sys_unique_id, added) values '
                . '(:product_id, :outerid, :auction, :sys_unique_id, :added)', $params);
    }

}
