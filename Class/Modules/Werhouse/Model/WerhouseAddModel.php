<?php

namespace App\Modules\Werhouse\Model;

use App\Model;
use App\User;
use App\Company;
use App\Common;
use App\Werhouse;

class WerhouseAddModel extends Model
{

    private $products;

    public function products($products)
    {
        $this->products = $products;
        return $this;
    }

    public function setIds()
    {
        foreach ($this->products as $key => $product) {
            $this->products[$key]['productId'] = $this->db()->getOne('select id from product where sys_unique_id=?', $product['productId']);
        }
    }

    public function add()
    {
        $this->setIds();
        foreach ($this->products as $product) {
            $this->db()->execute('insert into stock set '
                . '`count`=:count, '
                . 'product_id=:product_id, '
                . 'user_id=:user_id, '
                . 'company_id=:company_id, '
                . 'document_product_id=:document_product_id, '
                . 'sys_unique_id=:sys_unique_id, '
                . 'werhouse_id=:werhouse_id', [
                'count' => $product['count'],
                'product_id' => $product['productId'],
                'user_id' => User::getId(),
                'company_id' => Company::getId(),
                'document_product_id' => $product['documentProductId'],
                'sys_unique_id' => Common::getRandomChars(),
                'werhouse_id' => Werhouse::getId(),
            ]);
        }
    }

    public function dec()
    {
        $this->setIds();
        $products = [];
        foreach ($this->products as $product) {
            $count = $this->db()->getOne('select sum(`count`) from stock where product_id=:product_id', [
                'product_id' => $product['productId'],
            ]);
            if (!isset($count) || ($count < $product['count'])) {
                die('brak towaru');
            }
        };
        foreach ($this->products as $product) {
            $werhouseProducts = $this->db()->getAll('select id, `count`, document_product_id, product_id from stock where count>0 and product_id=:product_id order by id asc', [
                'product_id' => $product['productId'],
            ]);
            foreach ($werhouseProducts as $werhouseProduct) {
                if ($product['count'] == 0) {
                    break;
                }
                if (!isset($product['net'])) {
                    $prod = $this->db()->getRow('select buy_net, buy_tax, buy_gross from document_product where id=?', $product['productId']);
                    $product['net'] = $prod['buy_net'];
                    $product['tax'] = $prod['buy_tax'];
                    $product['gross'] = $prod['buy_gross'];
                }
                if ($werhouseProduct['count'] >= $product['count']) {
                    $products[] = [
                        'productId' => $werhouseProduct['product_id'],
                        'count' => $product['count'],
                        'documentProductId' => $werhouseProduct['document_product_id'],
                        'id' => $werhouseProduct['id'],
                        'net' => $product['net'],
                        'tax' => $product['tax'],
                        'gross' => $product['gross'],
                    ];
                    $product['count'] = 0;
                } else {
                    $products[] = [
                        'productId' => $werhouseProduct['product_id'],
                        'count' => $werhouseProduct['count'],
                        'documentProductId' => $werhouseProduct['document_product_id'],
                        'id' => $werhouseProduct['id'],
                        'net' => $product['net'],
                        'tax' => $product['tax'],
                        'gross' => $product['gross'],
                    ];
                    $product['count'] -= $werhouseProduct['count'];
                }
            }
        }
        foreach ($products as $product) {
            $this->db()->execute('update stock set '
                . '`count`=`count`-:count, '
                . 'werhouse_id=:werhouse_id '
                . 'where id=:id', [
                'count' => $product['count'],
                'werhouse_id' => Werhouse::getId(),
                'id' => $product['id'],
            ]);
        }
        return $products;
    }

    public function delete($documentId)
    {
        $documentId = $this->db()->getOne('select id from document where sys_unique_id=?', $documentId);
        $products = null;
        $type = $this->db()->getOne('select type from document where id=?', $documentId);
        if ($type == 'add') {
            $this->db()->execute('delete from stock where company_id=:company_id and '
                . 'exists(select 1 from document_product where document_id=:document_id '
                . 'and document_product.id=stock.document_product_id)', [
                'document_id' => $documentId,
                'company_id' => Company::getId(),
            ]);
        } else {
            $prds = $this->db()->getAll('select buy_net, buy_tax, buy_gross, product_id, '
                . 'count, document_product_id from document_product where document_id=? and true', $documentId);
            foreach ($prds as $product) {
                $products[] = [
                    'productId' => $this->db()->getOne('select sys_unique_id from product where id=?', $product['product_id']),
                    'count' => $product['count'],
                    'documentProductId' => $product['document_product_id'],
                    'net' => $product['buy_net'],
                    'tax' => $product['buy_tax'],
                    'gross' => $product['buy_gross'],
                ];
            }
        }
        return $products;
    }

}
