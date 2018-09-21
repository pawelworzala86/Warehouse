<?php

namespace App\Modules\Product\Model;

use App\Model;
use App\User;
use App\Common;
use App\Company;

class ProductDetailPageModel extends Model
{

    private $params;
    private $images = [];

    public function getProduct($id = null)
    {
        $product = $this->db()->getRow('select id, provider, mark, own, intermediate, description, '
            . 'description_short, sys_unique_id, name, sku, net, tax, gross from product '
            . 'where company_id=:company_id and sys_unique_id=:sys_unique_id', [
            'company_id' => Company::getId(),
            'sys_unique_id' => $id,
        ]);

        $product['images'] = [];
        $images = $this->db()->getAll('select product_file.sys_unique_id as id, '
            .'(select link from file where product_file.file_id=file.id limit 1) as big_image, '
            .'(select link from file where product_file.thumb_id=file.id limit 1) as image '
            .'from product_file '
            .'where product_id=? and product_file.deleted is null', $product['id']);
        foreach ($images as $image) {
            $product['images'][] = [
                'src' => $image['image'],
                'big_image' => $image['big_image'],
                'id' => $image['id'],
            ];
        }

        $product['net'] = number_format($product['net'], 2);
        $product['gross'] = number_format($product['gross'], 2);

        return $product;
    }

}
