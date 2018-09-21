<?php

namespace App\Modules\Werhouse\Model;

use App\Model;
use App\Company;
use App\Werhouse;

class WerhouseModel extends Model
{

    private $limit;

    public function __construct()
    {
        $this->limit = 50;

        parent::__construct();

        if (!isset($_SESSION['werhouse'])) {
            $this->filter(false);
        }
    }

    public function filter($notOverride = true)
    {
        $_SESSION['werhouse']['filter']['name'] = isset($_POST['name']) && $notOverride ? $_POST['name'] : null;
        $_SESSION['werhouse']['filter']['sku'] = isset($_POST['sku']) && $notOverride ? $_POST['sku'] : null;
    }

    public function getFilter()
    {
        return $_SESSION['werhouse']['filter'];
    }

    public function getProducts($page = 1)
    {
        $where = '';
        if (isset($_SESSION['werhouse']['filter']['name'])) {
            $where .= ' and product.name like \'%' . $_SESSION['werhouse']['filter']['name'] . '%\' ';
        }
        if (isset($_SESSION['werhouse']['filter']['sku'])) {
            $where .= ' and product.sku like \'%' . $_SESSION['werhouse']['filter']['sku'] . '%\' ';
        }
        $offset = $this->limit * ($page - 1);
        $werhouse = $this->db()->getAll('select product.sys_unique_id as id, product.sku, product.name, '
            .'sum(`count`) as `count`, '
            .'(select sum(`count`) from document_product where product_id=stock.product_id and exists('
            .'select 1 from document where id=document_product.document_id and deleted is null and werhouse_id=stock.werhouse_id and kind=\'REZ\')) as reservation, '
            .'product.net, product.tax, product.gross '
            . 'from stock '
            . 'left join product on product.id=stock.product_id '
            . 'where stock.company_id=? and stock.werhouse_id=? ' . $where . '  group by product.id, product.name '
            . 'limit ' . $this->limit . ' offset ' . $offset, [Company::getId(), Werhouse::getId()]);
        foreach ($werhouse as $key => $val) {
            $val['net'] = number_format($val['net'], 2);
            $val['gross'] = number_format($val['gross'], 2);
            $val['count'] = $val['count']-$val['reservation'];
            $werhouse[$key] = $val;
        }
        return $werhouse;
    }

    public function getWerhouse()
    {
        return $this->db()->getRow('select * from werhouse where id=?', Werhouse::getId());
    }

}
