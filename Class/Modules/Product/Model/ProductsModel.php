<?php

namespace App\Modules\Product\Model;

use App\Model;
use App\User;
use App\Company;

class ProductsModel extends Model
{

    private $limit;

    public function __construct()
    {
        $this->limit = 50;

        parent::__construct();

        if (!isset($_SESSION['products'])) {
            $this->filter(false);
        }
    }

    public function filter($notOverride = true)
    {
        $filter = $_POST['filter'];
        $_SESSION['products']['filter']['name'] = isset($filter['name']) && $notOverride ? $filter['name'] : null;
        $_SESSION['products']['filter']['sku'] = isset($filter['sku']) && $notOverride ? $filter['sku'] : null;
        $_SESSION['products']['filter']['intermediate'] = isset($filter['intermediate']) && $notOverride ? true : false;
        $_SESSION['products']['filter']['own'] = isset($filter['own']) && $notOverride ? true : false;
        $_SESSION['products']['filter']['price_from'] = isset($filter['price_from']) && $notOverride ? $filter['price_from'] : null;
        $_SESSION['products']['filter']['price_to'] = isset($filter['price_to']) && $notOverride ? $filter['price_to'] : null;
        $_SESSION['products']['filter']['provider'] = isset($filter['provider']) && $notOverride ? $filter['provider'] : null;
        $_SESSION['products']['filter']['mark'] = isset($filter['mark']) && $notOverride ? $filter['mark'] : null;
    }

    public function getFilter()
    {
        return $_SESSION['products']['filter'];
    }

    public function getWhere()
    {
        $where = '';
        if (isset($_SESSION['products']['filter']['name']) && !empty($_SESSION['products']['filter']['name'])) {
            $where .= ' and name like \'%' . $_SESSION['products']['filter']['name'] . '%\' ';
        }
        if (isset($_SESSION['products']['filter']['sku']) && !empty($_SESSION['products']['filter']['sku'])) {
            $where .= ' and sku like \'%' . $_SESSION['products']['filter']['sku'] . '%\' ';
        }
        if (isset($_SESSION['products']['filter']['intermediate']) && ($_SESSION['products']['filter']['intermediate'])) {
            $where .= ' and intermediate=1 ';
        }
        if (isset($_SESSION['products']['filter']['own']) && ($_SESSION['products']['filter']['own'])) {
            $where .= ' and own=1 ';
        }
        if (isset($_SESSION['products']['filter']['price_from']) && ($_SESSION['products']['filter']['price_from'] > 0)) {
            $where .= ' and net>' . (float)$_SESSION['products']['filter']['price_from'] . ' ';
        }
        if (isset($_SESSION['products']['filter']['price_to']) && ($_SESSION['products']['filter']['price_from'] > 0)) {
            $where .= ' and net<' . (float)$_SESSION['products']['filter']['price_to'] . ' ';
        }
        if (isset($_SESSION['products']['filter']['provider']) && !empty($_SESSION['products']['filter']['provider'])) {
            $where .= ' and provider like \'%' . $_SESSION['products']['filter']['provider'] . '%\' ';
        }
        if (isset($_SESSION['products']['filter']['mark']) && !empty($_SESSION['products']['filter']['mark'])) {
            $where .= ' and mark like \'%' . $_SESSION['products']['filter']['mark'] . '%\' ';
        }
        return $where;
    }

    public function getProducts($page)
    {
        $offset = $this->limit * ($page - 1);
        $products = $this->db()->getAll('select own, id, sys_unique_id, name, sku, '
            . '(select link from file where id=(select thumb_id from product_file where product_id=product.id and deleted is null limit 1)) as image, '
            . '(select link from file where id=(select file_id from product_file where product_id=product.id and deleted is null limit 1)) as big_image, '
            . '(select mail from user where id=product.user_id) as mail, '
            . 'net, tax, gross, description_short '
            . 'from product where company_id=? ' . $this->getWhere() . ' and deleted is null '
            . 'limit ' . $this->limit . ' offset ' . $offset, Company::getId());
        foreach ($products as $key => $val) {
            $val['net'] = number_format($val['net'], 2);
            $val['gross'] = number_format($val['gross'], 2);
            $val['auction'] = $this->db()->getAll('select * from product_auction where product_id=?', $val['id']);
            $products[$key] = $val;
        }
        return $products;
    }

    public function delete($id)
    {
        return $this->db()->execute('update product set deleted=:deleted, user_id=:user_id where company_id=:company_id and id=:id', [
            'company_id' => Company::getId(),
            'user_id' => User::getId(),
            'id' => $id,
            'deleted' => time(),
        ]);
    }

}
