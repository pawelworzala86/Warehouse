<?php

namespace App\Modules\Product\Model;

use App\Model;
use App\User;
use App\Common;
use App\Company;

class ProductImageDeleteModel extends Model
{

    public function delete(string $id)
    {
        $this->db()->execute('update product_file set deleted=:deleted where sys_unique_id=:sys_unique_id and exists(select 1 from '
            . 'product where product.id=product_file.product_id and company_id=:company_id)', [
            'deleted' => time(),
            'company_id' => Company::getId(),
            'sys_unique_id' => $id,
        ]);
    }

}
