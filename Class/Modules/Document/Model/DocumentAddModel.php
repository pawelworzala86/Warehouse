<?php

namespace App\Modules\Document\Model;

use App\Model;
use App\User;
use App\Common;
use App\Werhouse;
use DateTime;
use App\Company;

class DocumentAddModel extends Model
{

    private $products;
    private $type;
    private $contractor;
    private $kind;
    private $document;

    public function __construct()
    {
        parent::__construct();
        $this->type = 'add';
    }

    public function products($products)
    {
        $this->products = $products;
        return $this;
    }

    public function contractor($contractor)
    {
        $this->contractor = $contractor;
        return $this;
    }

    public function document($document)
    {
        $this->document = $document;
        return $this;
    }

    public function dec()
    {
        $this->type = 'dec';
        $this->add();
    }

    public function getNumber()
    {
        $count = $this->db()->getOne('select count(*)+1 from document where kind=? and user_id=?', [
            $this->kind,
            User::getId(),
        ]);
        return $this->kind . '/' . $count . '/2018';
    }

    public function add()
    {
        $this->kind = $this->document['kind'];

        $number = $this->getNumber();

        $contractorId = null;
        if (isset($this->contractor['sys_unique_id'])) {
            $contractorId = $this->db()->getOne('select id from contractor where sys_unique_id=?', $this->contractor['sys_unique_id']);
        }

        $productionId = isset($this->document['production_id']) ? $this->db()->getOne('select id from production where sys_unique_id=?', $this->document['production_id']) : null;

        $params = [
            'user_id' => User::getId(),
            'company_id' => Company::getId(),
            'type' => $this->type,
            'sys_unique_id' => Common::getRandomChars(),
            'contractor_id' => $contractorId,
            'added' => time(),
            'kind' => $this->kind,
            'number' => $number,
            'date_add' => DateTime::createFromFormat('d-m-Y  G:i', $this->document['date_add'] . ' 00:00')->getTimestamp(),
            'date_act' => DateTime::createFromFormat('d-m-Y  G:i', $this->document['date_act'] . ' 00:00')->getTimestamp(),
            'city' => $this->document['city'],
            'date_pay' => DateTime::createFromFormat('d-m-Y  G:i', $this->document['date_pay'] . ' 00:00')->getTimestamp(),
            'payment' => $this->document['payment'],
            'payed' => !empty($this->document['payed']) ? $this->document['payed'] : 0,
            'production_id' => $productionId,
            'werhouse_id' => Werhouse::getId(),
        ];
        $this->db()->execute('insert into document set production_id=:production_id, company_id=:company_id, '
            . 'user_id=:user_id, type=:type, '
            . 'sys_unique_id=:sys_unique_id, contractor_id=:contractor_id, added=:added, kind=:kind, '
            . 'number=:number, date_add=:date_add, date_act=:date_act, city=:city, date_pay=:date_pay, '
            . 'payment=:payment, payed=:payed, werhouse_id=:werhouse_id', $params);
        $documentId = $this->db()->insertId();

        $products = [];
        foreach ($this->products as $product) {
            $params = [
                'count' => $product['count'],
                'product_id' => is_numeric($product['productId']) ? $product['productId'] :
                    $this->db()->getOne('select id from product where sys_unique_id=?', $product['productId']),
                'document_id' => $documentId,
                'document_product_id' => isset($product['documentProductId']) ? $product['documentProductId'] : null,
                'sys_unique_id' => Common::getRandomChars(),
            ];
            $params['buy_net'] = null;
            $params['buy_tax'] = null;
            $params['buy_gross'] = null;
            $params['sell_net'] = null;
            $params['sell_tax'] = null;
            $params['sell_gross'] = null;
            if ($this->type == 'add') {
                if (!isset($product['net'])) {
                    $prod = $this->db()->getRow('select buy_net, buy_tax, buy_gross from document_product where sys_unique_id=?', $product['productId']);
                    $product['net'] = $prod['buy_net'];
                    $product['tax'] = $prod['buy_tax'];
                    $product['gross'] = $prod['buy_gross'];
                    $prod = $this->db()->getRow('select net, tax, gross from product where id=?', $params['product_id']);
                    $params['sell_net'] = $prod['net'];
                    $params['sell_tax'] = $prod['tax'];
                    $params['sell_gross'] = $prod['gross'];
                }
                $params['buy_net'] = $product['net'];
                $params['buy_tax'] = $product['tax'];
                $params['buy_gross'] = $product['gross'];
            } else {
                $prod = null;
                if (isset($product['documentProductId'])) {
                    $prod = $this->db()->getRow('select buy_net, buy_tax, buy_gross from document_product where id=?', $product['documentProductId']);
                }
                if (!isset($prod['buy_net'])) {
                    $prod = $this->db()->getRow('select buy_net, buy_tax, buy_gross from document_product where sys_unique_id=?', $product['productId']);
                }
                $params['buy_net'] = $prod['buy_net'];
                $params['buy_tax'] = $prod['buy_tax'];
                $params['buy_gross'] = $prod['buy_net'];
                $params['sell_net'] = $product['net'];
                $params['sell_tax'] = $product['tax'];
                $params['sell_gross'] = $product['gross'];
            }
            $this->db()->execute('insert into document_product set `count`=:count, '
                . 'product_id=:product_id, '
                . 'document_id=:document_id, '
                . 'document_product_id=:document_product_id, '
                . 'buy_net=:buy_net, '
                . 'buy_tax=:buy_tax, '
                . 'buy_gross=:buy_gross, '
                . 'sell_net=:sell_net, '
                . 'sell_tax=:sell_tax, '
                . 'sell_gross=:sell_gross,'
                . 'sys_unique_id=:sys_unique_id ', $params);
            $product['documentProductId'] = $this->db()->insertId();
            $products[] = $product;
        }
        return [
            'products' => $products,
            'documentId' => $documentId
        ];
    }

}
