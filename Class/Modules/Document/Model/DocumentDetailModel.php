<?php

namespace App\Modules\Document\Model;

use App\Model;
use App\Company;

class DocumentDetailModel extends Model
{

    public function getContractor($id)
    {
        return $this->db()->getRow('select * from address where id=(select address_id from contractor where '.
            ' id=(select contractor_id from document where sys_unique_id=? and company_id=?))', [$id, Company::getId()]);
    }


    public function getProducts($id)
    {
        $products = $this->db()->getAll('select `count`, product.sku, product.name, (buy_net*`count`) as buy_net, '
            .'(sell_net*`count`) as sell_net '
            .'from document_product left join product on product.id=product_id where document_id='
            .'(select id from document where sys_unique_id=? and company_id=?)', [$id, Company::getId()]);
        foreach ($products as $key=>$product){
            $product['buy_net'] = number_format($product['buy_net'], 2);
            $product['sell_net'] = number_format($product['sell_net'], 2);
            $products[$key] = $product;
        }
        return $products;
    }

}
