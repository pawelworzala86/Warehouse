<?php

namespace App\Modules\Production\Model;

use App\Model;
use App\User;
use App\Company;
use App\Common;

class ProductionWorkersModel extends Model
{

    public function __construct()
    {
        parent::__construct();

        if (!isset($_SESSION['productions-workers'])) {
            $this->filter(false);
        }
    }

    public function filter($notOverride = true)
    {
        $_SESSION['productions-workers']['filter']['name'] = isset($_POST['name']) && $notOverride ? $_POST['name'] : null;
    }

    public function getFilter()
    {
        return $_SESSION['productions-workers']['filter'];
    }

    public function getProductionWorkers($id)
    {
        $where = '';
        if (isset($_SESSION['productions-workers']['filter']['name'])) {
            $where .= ' and name like \'%' . $_SESSION['productions-workers']['filter']['name'] . '%\' ';
        }
        $workers = $this->db()->getAll('select production_worker.sys_unique_id, name, production_worker.id, hours from production_worker '
            . 'left join worker on worker.id=production_worker.worker_id '
            . 'where production_worker.company_id=? ' . $where . ' and production_worker.deleted is null and production_worker.production_id=?', [
            Company::getId(),
            $this->db()->getOne('select id from production where sys_unique_id=?', $id),
        ]);
        return $workers;
    }

    public function delete($id)
    {
        return $this->db()->execute('update production_worker set deleted=:deleted, user_id=:user_id where company_id=:company_id and sys_unique_id=:sys_unique_id', [
            'company_id' => Company::getId(),
            'user_id' => User::getId(),
            'sys_unique_id' => $id,
            'deleted' => time(),
        ]);
    }

    public function add($data)
    {
        $this->db()->execute('insert into production_worker (sys_unique_id, user_id, company_id, production_id,'
            . 'worker_id, hours) values '
            . '(:sys_unique_id, :user_id, :company_id, :production_id, :worker_id, :hours)', [
            'sys_unique_id' => Common::getRandomChars(),
            'user_id' => User::getId(),
            'company_id' => Company::getId(),
            'production_id' => $this->db()->getOne('select id from production where sys_unique_id=?', $data['productionId']),
            'worker_id' => $this->db()->getOne('select id from worker where sys_unique_id=?', $data['workerId']),
            'hours' => 8,
        ]);
        echo json_encode(true);
        exit;
    }

}
