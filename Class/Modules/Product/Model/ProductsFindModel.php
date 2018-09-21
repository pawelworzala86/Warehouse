<?php

namespace App\Modules\Product\Model;

use App\Model;
use App\Company;
use App\Werhouse;

class ProductsFindModel extends Model
{

    public function getProducts(array $search = [], bool $countAdd = false, bool $intermediate = false): array
    {
        $params = [Werhouse::getId(), Company::getId()];
        $where = '';
        /*$searchNames = [
            'sku' => function ($val) {
                return ' and sku like \'%' . $val . '%\' ';
            },
            'name' => function ($val) {
                return ' and name like \'%' . $val . '%\' ';
            },
        ];
        foreach ($search as $sear) {
            $where .= $searchNames[$sear['name']]($sear['value']);
        }*/
        if ($intermediate) {
            $where .= ' and intermediate=1 ';
        }
        $where2 = '';
        if ($countAdd) {
            $where2 .= ' and `count`>0 ';
            $where .= ' and exists(select 1 from stock where product_id=product.id and werhouse_id=?) ';
            $params[] = Werhouse::getId();
        }
        $result = [];
        $products = $this->db()->getAll('select * from '
            . '(select product.sys_unique_id, product.sku, product.name, '
            . '(select sum(`count`) from stock where product_id=product.id) as count, '
            . '(select sum(`count`) from document_product where product_id=product.id and exists('
            . 'select 1 from document where id=document_product.document_id and deleted is null and werhouse_id=? and kind=\'REZ\')) as reservation, '
            . 'product.net, product.tax, product.gross '
            . 'from product '
            . 'where product.company_id=? ' . $where . ' '
            . 'group by product.id, product.name) as x where true ' . $where2 . ' limit 5', $params);
        foreach ($products as $product) {
            $result[] = [
                'id' => $product['sys_unique_id'],
                'name' => $product['name'],
                'sku' => $product['sku'],
                'net' => number_format($product['net'], 2),
                'tax' => $product['tax'],
                'gross' => number_format($product['gross'], 2),
                'count' => $product['count']-$product['reservation'],
                'reservation' => $product['reservation'],
            ];
        }
        return $result;
    }

}
