<?php

namespace App\Modules\Werhouse\Model;

use App\Model;
use App\Werhouse;
use App\Company;

class WerhouseProductsModel extends Model
{

    public function getProductsString(array $id)
    {
        $buf = "";
        $products = $this->db()->getAll("select *, "
            ."1 as count "
            ."from product where sys_unique_id in ('".join("', '", $id)."') and company_id=?", Company::getId());
        foreach ($products as $product){
            $buf = "['".$product['sys_unique_id']."', ".$product['count'].", ".$product['net'].", '".$product['tax']."', ".$product['gross'].", '".$product['name']."']";
        }
        return "[$buf]";
    }

    public function getProducts(array $id)
    {
        $products = $this->db()->getAll("select *, sys_unique_id as pid, "
            ."1 as count "
            ."from product where sys_unique_id in ('".join("', '", $id)."') and company_id=?", Company::getId());
        return $products;
    }

}
