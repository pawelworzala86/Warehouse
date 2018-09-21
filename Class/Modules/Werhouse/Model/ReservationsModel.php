<?php

namespace App\Modules\Werhouse\Model;

use App\Model;
use App\Company;
use App\Werhouse;

class ReservationsModel extends Model
{

    private $limit;

    public function __construct()
    {
        $this->limit = 50;

        parent::__construct();

        if (!isset($_SESSION['reservations'])) {
            $this->filter(false);
        }
    }

    public function filter($notOverride = true)
    {
        $_SESSION['reservations']['filter']['name'] = isset($_POST['name']) && $notOverride ? $_POST['name'] : null;
    }

    public function getFilter()
    {
        return $_SESSION['reservations']['filter'];
    }

    public function getReservations($page)
    {
        $where = '';
        if (isset($_SESSION['reservations']['filter']['name'])) {
            $where .= ' and name like \'%' . $_SESSION['reservations']['filter']['name'] . '%\' ';
        }
        $offset = $this->limit * ($page - 1);
        $reservations = $this->db()->getAll('select (select name from contractor where id=contractor_id) as contractor, '
            . '(select sum(sell_net*`count`) from document_product where document_id=document.id) as sum_net, '
            . 'number, sys_unique_id, id '
            . 'from document '
            . 'where company_id=? and kind=\'REZ\' and deleted is null and werhouse_id=?' . $where . ' '
            . 'limit ' . $this->limit . ' offset ' . $offset, [Company::getId(), Werhouse::getId()]);
        foreach ($reservations as $key=>$reservation){
            $products = $this->db()->getAll('select *, sum(sell_net*count) as sum_net from document_product '
                .'left join product on product.id=document_product.product_id '
                .' where document_id=?', $reservation['id']);
            foreach ($products as $productKey=>$product){
                $product['sum_net'] = number_format($product['sum_net'], 2);
                $products[$productKey] = $product;
            }
            $reservation['products'] = $products;
            $reservation['sum_net'] = number_format($reservation['sum_net'], 2);
            $reservations[$key] = $reservation;
        }
        return $reservations;
    }

}
