<?php

namespace App\Modules\Contractor\Model;

use App\Model;
use App\Company;
use App\User;

class ContractorsModel extends Model
{

    private $limit;

    public function __construct()
    {
        $this->limit = 50;

        parent::__construct();

        if (!isset($_SESSION['contractors'])) {
            $this->filter(false);
        }
    }

    public function filter($notOverride = true)
    {
        $_SESSION['contractors']['filter']['code'] = isset($_POST['code']) && $notOverride ? $_POST['code'] : null;
        $_SESSION['contractors']['filter']['name'] = isset($_POST['name']) && $notOverride ? $_POST['name'] : null;
        $_SESSION['contractors']['filter']['provider'] = isset($_POST['provider']) && $notOverride ? $_POST['provider'] : null;
        $_SESSION['contractors']['filter']['recipient'] = isset($_POST['recipient']) && $notOverride ? $_POST['recipient'] : null;
    }

    public function getFilter()
    {
        return $_SESSION['contractors']['filter'];
    }

    public function getWhere()
    {
        $where = '';
        if (isset($_SESSION['contractors']['filter']['code']) && !empty($_SESSION['contractors']['filter']['code'])) {
            $where .= ' and code like \'%' . $_SESSION['contractors']['filter']['code'] . '%\' ';
        }
        if (isset($_SESSION['contractors']['filter']['name']) && !empty($_SESSION['contractors']['filter']['name'])) {
            $where .= ' and name like \'%' . $_SESSION['contractors']['filter']['name'] . '%\' ';
        }
        if (isset($_SESSION['contractors']['filter']['provider']) && $_SESSION['contractors']['filter']['provider']) {
            $where .= ' and provider=1 ';
        }
        if (isset($_SESSION['contractors']['filter']['recipient']) && $_SESSION['contractors']['filter']['recipient']) {
            $where .= ' and recipient=1 ';
        }
        return $where;
    }

    public function getContractors($page)
    {
        $offset = $this->limit * ($page - 1);
        return $this->db()->getAll('select provider, recipient, nip, mail, code, sys_unique_id, name ' .
            'from contractor where company_id=? ' . $this->getWhere() . ' and deleted is null '
            . 'limit ' . $this->limit . ' offset ' . $offset, Company::getId());
    }

    public function delete($id)
    {
        return $this->db()->execute('update contractor set deleted=:deleted, user_id=:user_id where company_id=:company_id and sys_unique_id=:sys_unique_id', [
            'company_id' => Company::getId(),
            'user_id' => User::getId(),
            'sys_unique_id' => $id,
            'deleted' => time(),
        ]);
        $this->header('Location: \kontrahenci');
        exit;
    }

}
