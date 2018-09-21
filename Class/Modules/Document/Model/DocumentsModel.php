<?php

namespace App\Modules\Document\Model;

use App\Model;
use App\Company;

class DocumentsModel extends Model
{

    private $limit;

    public function __construct()
    {
        $this->limit = 50;

        parent::__construct();

        if (!isset($_SESSION['documents'])) {
            $this->filter(false);
        }
    }

    public function filter($notOverride = true)
    {
        $filter = $_POST['filter'];
        $_SESSION['documents']['filter']['name'] = isset($filter['name']) && $notOverride ? $filter['name'] : null;
        $_SESSION['documents']['filter']['number'] = isset($filter['number']) && $notOverride ? $filter['number'] : null;
    }

    public function getFilter()
    {
        return $_SESSION['documents']['filter'];
    }

    public function getWhere()
    {
        $where = '';
        if (isset($_SESSION['documents']['filter']['name']) && !empty($_SESSION['documents']['filter']['name'])) {
            $where .= ' and contractor like \'%' . $_SESSION['documents']['filter']['name'] . '%\' ';
        }
        if (isset($_SESSION['documents']['filter']['number']) && !empty($_SESSION['documents']['filter']['number'])) {
            $where .= ' and number like \'%' . $_SESSION['documents']['filter']['number'] . '%\' ';
        }
        return $where;
    }

    public function getDocuments($page)
    {
        $offset = $this->limit * ($page - 1);
        $documents = $this->db()->getAll('select *, from_unixtime(date_add,\'%d-%m-%Y\') as date from (select date_add, sys_unique_id as id, id as _id, number, '
            . '(select name from contractor where id=contractor_id) as contractor, '
            . '(select sum(buy_net*count) from document_product where document_id=document.id) as buy_net, '
            . '(select sum(sell_net*count) from document_product where document_id=document.id) as sell_net '
            . 'from document where company_id=? and deleted is null) as x where true ' . $this->getWhere() . ' order by _id desc '
            . 'limit ' . $this->limit . ' offset ' . $offset, Company::getId());
        foreach ($documents as $key => $document) {
            $document['buy_net'] = number_format($document['buy_net'], 2);
            $document['sell_net'] = number_format($document['sell_net'], 2);
            $documents[$key] = $document;
        }
        return $documents;
    }

}
