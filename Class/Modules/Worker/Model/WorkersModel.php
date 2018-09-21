<?php

namespace App\Modules\Worker\Model;

use App\Model;
use App\User;
use App\Company;

class WorkersModel extends Model
{

    public function __construct()
    {
        parent::__construct();

        if (!isset($_SESSION['workers'])) {
            $this->filter(false);
        }
    }

    public function filter($notOverride = true)
    {
        $_SESSION['workers']['filter']['name'] = isset($_POST['name']) && $notOverride ? $_POST['name'] : null;
    }

    public function getFilter()
    {
        return $_SESSION['workers']['filter'];
    }

    public function getWorkers()
    {
        $where = '';
        if (isset($_SESSION['workers']['filter']['name']) && !empty($_SESSION['workers']['filter']['name'])) {
            $where .= ' and name like \'%' . $_SESSION['workers']['filter']['name'] . '%\' ';
        }
        $workers = $this->db()->getAll('select occupation, sys_unique_id, name, id, sollary from worker where company_id=? ' . $where . ' and deleted is null', Company::getId());
        foreach ($workers as $key => $worker) {
            $worker['sollary'] = number_format($worker['sollary'], 2);
            $labels = [];
            $costData = [];
            $profitData = [];
            for ($i = 1; $i < 30; $i++) {
                $labels[] = $i;
                $costData[] = rand(10, 15);
                $profitData[] = rand(20, 25);
            }
            $worker['labels'] = '[\'' . join('\',\'', $labels) . '\']';
            $worker['cost']['data'] = '[' . join(',', $costData) . ']';
            $worker['profit']['data'] = '[' . join(',', $profitData) . ']';
            $workers[$key] = $worker;
        }
        return $workers;
    }

    public function delete($id)
    {
        return $this->db()->execute('update worker set deleted=:deleted, user_id=:user_id where company_id=:company_id and sys_unique_id=:sys_unique_id', [
            'company_id' => Company::getId(),
            'user_id' => User::getId(),
            'sys_unique_id' => $id,
            'deleted' => time(),
        ]);
    }

}
