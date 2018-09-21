<?php

namespace App\Modules\Contractor\Model;

use App\Model;
use App\Company;
use App\User;

class DebtsModel extends Model
{

    private $limit;

    public function __construct()
    {
        $this->limit = 50;

        parent::__construct();

        if (!isset($_SESSION['debts'])) {
            $this->filter(false);
        }
    }

    public function filter($notOverride = true)
    {
        $_SESSION['debts']['filter']['code'] = isset($_POST['code']) && $notOverride ? $_POST['code'] : null;
        $_SESSION['debts']['filter']['name'] = isset($_POST['name']) && $notOverride ? $_POST['name'] : null;
    }

    public function getFilter()
    {
        return $_SESSION['debts']['filter'];
    }

    public function getWhere()
    {
        $where = '';
        if (isset($_SESSION['debts']['filter']['code']) && !empty($_SESSION['debts']['filter']['code'])) {
            $where .= ' and code like \'%' . $_SESSION['debts']['filter']['code'] . '%\' ';
        }
        if (isset($_SESSION['debts']['filter']['name']) && !empty($_SESSION['debts']['filter']['name'])) {
            $where .= ' and name like \'%' . $_SESSION['debts']['filter']['name'] . '%\' ';
        }
        return $where;
    }

    public function getContractors($page)
    {
        $offset = $this->limit * ($page - 1);
        $debts = $this->db()->getAll('select * from (select id, provider, recipient, nip, mail, code, sys_unique_id, name, '
            .'(select sum(sell_gross*count) from document_product where document_id in '
            .'(select id from document where document.contractor_id=contractor.id and document.type=\'dec\')) '
            .'-(select sum(payed) from document where document.contractor_id=contractor.id and document.type=\'dec\') as debt '
            .'from contractor where company_id=? ' . $this->getWhere() . ' and deleted is null '
            . 'limit ' . $this->limit . ' offset ' . $offset.') as x where debt>0', Company::getId());
        foreach ($debts as $key=>$debt){
            $debt['debt'] = number_format($debt['debt'], 2);
            $documents = $this->db()->getAll('select * from (select payed, number, from_unixtime(date_add,\'%d-%m-%Y\') as date_add, '
                    .'from_unixtime(date_pay,\'%d-%m-%Y\') as date_pay, '
                    .'round((select sum(sell_gross*count) from document_product where document_id=document.id)-payed, 2) as debt '
                    .'from document where document.contractor_id=? and document.type=\'dec\' order by date_pay desc) as x where debt>0', $debt['id']);
            $debt['documents'] = $documents;
            $debts[$key] = $debt;
        }
        return $debts;
    }

    public function delete($id)
    {
        return $this->db()->execute('update contractor set deleted=:deleted, user_id=:user_id where company_id=:company_id and sys_unique_id=:sys_unique_id', [
            'company_id' => Company::getId(),
            'user_id' => User::getId(),
            'sys_unique_id' => $id,
            'deleted' => time(),
        ]);
    }

}
