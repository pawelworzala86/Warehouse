<?php

namespace App\Modules\Stat\Model;

use App\Model;
use App\Company;
use App\Werhouse;
use DateTime;

class StatProductBuyModel extends Model
{
    public function __construct()
    {
        parent::__construct();

        if (!isset($_SESSION['stat-product-buy'])) {
            $this->filter(false);
        }
    }

    public function filter($notOverride = true)
    {
        $filter = $_POST['filter'];
        $_SESSION['stat-product-buy']['filter']['name'] = isset($filter['name']) && $notOverride ? $filter['name'] : null;
        $_SESSION['stat-product-buy']['filter']['sku'] = isset($filter['sku']) && $notOverride ? $filter['sku'] : null;
        $_SESSION['stat-product-buy']['filter']['date_from'] = isset($filter['date_from']) && $notOverride ? $filter['date_from'] : null;
        $_SESSION['stat-product-buy']['filter']['date_to'] = isset($filter['date_to']) && $notOverride ? $filter['date_to'] : null;
        $_SESSION['stat-product-buy']['filter']['price_from'] = isset($filter['price_from']) && $notOverride ? $filter['price_from'] : null;
        $_SESSION['stat-product-buy']['filter']['price_to'] = isset($filter['price_to']) && $notOverride ? $filter['price_to'] : null;
    }

    public function getFilter()
    {
        return $_SESSION['stat-product-buy']['filter'];
    }

    public function getFilterPrint()
    {
        $filters = [
            [
                'name' => 'SKU',
                'value' => $_SESSION['stat-product-buy']['filter']['sku'],
            ],
            [
                'name' => 'Nazwa',
                'value' => $_SESSION['stat-product-buy']['filter']['name'],
            ],
            [
                'name' => 'Data od',
                'value' => $_SESSION['stat-product-buy']['filter']['date_from'],
            ],
            [
                'name' => 'Data do',
                'value' => $_SESSION['stat-product-buy']['filter']['date_to'],
            ],
            [
                'name' => 'Cena od',
                'value' => $_SESSION['stat-product-buy']['filter']['price_from'],
            ],
            [
                'name' => 'Cena do',
                'value' => $_SESSION['stat-product-buy']['filter']['price_to'],
            ],
        ];
        return $filters;
    }

    public function getBuys()
    {
        $where = '';
        $where2 = '';
        if (isset($_SESSION['stat-product-buy']['filter']['name']) && !empty($_SESSION['stat-product-buy']['filter']['name'])) {
            $where .= ' and product.name like \'%' . $_SESSION['stat-product-buy']['filter']['name'] . '%\' ';
        }
        if (isset($_SESSION['stat-product-buy']['filter']['sku']) && !empty($_SESSION['stat-product-buy']['filter']['sku'])) {
            $where .= ' and product.sku like \'%' . $_SESSION['stat-product-buy']['filter']['sku'] . '%\' ';
        }
        if (isset($_SESSION['stat-product-buy']['filter']['date_from']) && !empty($_SESSION['stat-product-buy']['filter']['date_from'])) {
            $date_from = DateTime::createFromFormat('d-m-Y  G:i', $_SESSION['stat-product-buy']['filter']['date_from'] . ' 00:00')->getTimestamp();
            $where .= ' and document.date_add>=' . $date_from . ' ';
        }
        if (isset($_SESSION['stat-product-buy']['filter']['date_to']) && !empty($_SESSION['stat-product-buy']['filter']['date_to'])) {
            $date_to = DateTime::createFromFormat('d-m-Y  G:i', $_SESSION['stat-product-buy']['filter']['date_to'] . ' 00:00')->getTimestamp();
            $where .= ' and document.date_add<=' . $date_to . ' ';
        }
        if (isset($_SESSION['stat-product-buy']['filter']['price_from']) && !empty($_SESSION['stat-product-buy']['filter']['price_from'])) {
            $where2 .= ' and sum_net>=' . $_SESSION['stat-product-buy']['filter']['price_from'] . ' ';
        }
        if (isset($_SESSION['stat-product-buy']['filter']['price_to']) && !empty($_SESSION['stat-product-buy']['filter']['price_to'])) {
            $where2 .= ' and sum_net<=' . $_SESSION['stat-product-buy']['filter']['price_to'] . ' ';
        }
        $buys = $this->db()->getAll('select * from (select `count`, sku, buy_net, buy_tax, buy_gross, name, number, sum(buy_net*count) as sum_net, from_unixtime(date_add,\'%d-%m-%Y\') as date_add from document_product '
            . 'left join document on document.id=document_product.document_id '
            . 'left join product on product.id=document_product.product_id '
            . 'where type=\'add\' ' . $where . ' and buy_net is not null and document.company_id=? '
            .'group by document.id, product.id order by document.id desc) as x where true '.$where2, Company::getId());
        $sum = 0;
        foreach ($buys as $key => $val) {
            $sum += $val['sum_net'];
            $val['buy_net'] = number_format($val['buy_net'], 2);
            $val['sum_net'] = number_format($val['sum_net'], 2);
            $buys[$key] = $val;
        }
        $sum = number_format($sum, 2);
        return [
            'products' => $buys,
            'sum' => $sum,
        ];
    }

    public function getWerhouse()
    {
        return $this->db()->getRow('select * from werhouse where id=?', Werhouse::getId());
    }

}
