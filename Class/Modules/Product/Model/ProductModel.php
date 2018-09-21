<?php

namespace App\Modules\Product\Model;

use App\Model;
use App\User;
use App\Common;
use App\Company;

class ProductModel extends Model
{

    private $params;
    private $images = [];
    private $catalogIds = [];

    public function getProduct($id = null)
    {
        if(!isset($id)){
            @$this->setParams([]);
            return $this->params;
        }

        $product = $this->db()->getRow('select id, provider, mark, own, intermediate, description, '
            . 'description_short, sys_unique_id, name, sku, net, tax, gross from product '
            . 'where company_id=:company_id and sys_unique_id=:sys_unique_id', [
            'company_id' => Company::getId(),
            'sys_unique_id' => $id,
        ]);

        if(!isset($product['id'])){
            return $product;
        }

        $product['images'] = [];
        $images = $this->db()->getAll('select product_file.sys_unique_id as id, '
            .'(select link from file where product_file.file_id=file.id limit 1) as big_image, '
            .'(select link from file where product_file.thumb_id=file.id limit 1) as image '
            .'from '
            .'product_file '
            .'where product_id=? and deleted is null', $product['id']);
        foreach ($images as $image) {
            $product['images'][] = [
                'src' => $image['image'],
                'big_image' => $image['big_image'],
                'id' => $image['id'],
            ];
        }

        return $product;
    }

    public function setParams($data)
    {
        $this->params['sys_unique_id'] = $data['sys_unique_id'];
        $this->params['name'] = $data['name'];
        $this->params['sku'] = $data['sku'];
        $this->params['user_id'] = User::getId();
        $this->params['company_id'] = Company::getId();
        $this->params['net'] = $data['net'];
        $this->params['tax'] = $data['tax'];
        $this->params['gross'] = $data['gross'];
        $this->params['description'] = $data['description'];
        $this->params['description_short'] = $data['description_short'];
        $this->params['intermediate'] = (isset($data['intermediate']) && ($data['intermediate'] == 'true')) ? 1 : 0;
        $this->params['own'] = (isset($data['own']) && ($data['own'] == 'true')) ? 1 : 0;
        $this->params['provider'] = $data['provider'];
        $this->params['mark'] = $data['mark'];
    }

    public function addPicture(int $fileId, int $thumbId):void
    {
        $this->images[] = [
            'file_id'=>$fileId,
            'thumb_id'=>$thumbId,
        ];
    }

    public function save()
    {
        $sql = 'insert into product (mark, provider, own, intermediate, description_short, description, company_id, sys_unique_id, name, user_id, sku, net, tax, gross) values '
            . '(:mark, :provider, :own, :intermediate, :description_short, :description, :company_id, :sys_unique_id, :name, :user_id, :sku, :net, :tax, :gross)';
        if (!empty($this->params['sys_unique_id'])) {
            $sql = 'update product set mark=:mark, provider=:provider, own=:own, intermediate=:intermediate, '
                . 'description_short=:description_short, description=:description, user_id=:user_id, name=:name, sku=:sku, net=:net, tax=:tax, gross=:gross where sys_unique_id=:sys_unique_id and company_id=:company_id';
        } else {
            $this->params['sys_unique_id'] = Common::getRandomChars();
        }
        $this->db()->execute($sql, $this->params);
        $this->params['id'] = $this->db()->getOne('select id from product where sys_unique_id=?', $this->params['sys_unique_id']);

        foreach ($this->images as $image) {
            $this->db()->execute('insert into product_file (thumb_id, product_id, file_id, sys_unique_id) values (:thumb_id, :product_id, :file_id, :sys_unique_id)', [
                'product_id' => $this->params['id'],
                'file_id' => $image['file_id'],
                'thumb_id' => $image['thumb_id'],
                'sys_unique_id' => Common::getRandomChars(),
            ]);
        }

        $catalogIds = isset($_POST['catalogIds'])?$_POST['catalogIds']:[];
        $this->db()->execute('delete from product_catalog where product_id=?', $this->params['id']);
        foreach($catalogIds as $key=>$catalogId){
            $this->db()->execute('insert into product_catalog set product_id=?, catalog_id=?', [
                $this->params['id'], $this->db()->getOne('select id from catalog where sys_unique_id=? and company_id=?', [
                    $key, Company::getId(),
                ]),
            ]);
        }

        $this->header('Location: /produkty');
    }

}
