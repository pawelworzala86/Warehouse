<?php

namespace App\Modules\Production\Model;

use App\Model;
use App\User;
use App\Company;
use App\Common;
use DateTime;

class ProductionDayModel extends Model
{

    public function __construct()
    {
        parent::__construct();

        /* if (!isset($_SESSION['productions-workers'])) {
          $this->filter(false);
          } */
    }

    /* public function filter($notOverride = true) {
      $_SESSION['productions-workers']['filter']['name'] = isset($_POST['name']) && $notOverride ? $_POST['name'] : null;
      }

      public function getFilter() {
      return $_SESSION['productions-workers']['filter'];
      } */

    public function getProductionWorkers($id)
    {
        $where = '';
        if (isset($_SESSION['productions-workers']['filter']['name'])) {
            $where .= ' and name like \'%' . $_SESSION['productions-workers']['filter']['name'] . '%\' ';
        }
        $workers = $this->db()->getAll('select production_worker.sys_unique_id, name, production_worker.id, hours from production_worker '
            . 'left join worker on worker.id=production_worker.worker_id '
            . 'where production_worker.company_id=? ' . $where . ' and production_worker.deleted is null '
            . 'and production_id=?', [
            Company::getId(),
            $this->db()->getOne('select id from production where sys_unique_id=?', $id)
        ]);
        return $workers;
    }

    /* public function delete($id) {
      return $this->db()->execute('update production_worker set deleted=:deleted, user_id=:user_id where company_id=:company_id and sys_unique_id=:sys_unique_id', [
      'company_id' => Company::getId(),
      'user_id' => User::getId(),
      'sys_unique_id' => $id,
      'deleted' => time(),
      ]);
      } */

    public function add($data)
    {
        $productionId = $this->db()->getOne('select id from production where sys_unique_id=?', $data['id']);
        $this->db()->execute('insert into production_day set company_id=:company_id, user_id=:user_id, '
            . 'production_id=:production_id, sys_unique_id=:sys_unique_id, date=:date', [
            'company_id' => Company::getId(),
            'user_id' => User::getId(),
            'production_id' => $productionId,
            'sys_unique_id' => Common::getRandomChars(),
            'date' => DateTime::createFromFormat('d-m-Y  G:i', $data['date'] . ' 00:00')->getTimestamp(),
        ]);
        $productionDayId = $this->db()->insertId();
        foreach ($data['day'] as $key => $day) {
            $workerId = $this->db()->getOne('select worker_id from production_worker where sys_unique_id=?', $key);
            $worker = $this->db()->getRow('select sollary from worker where id=?', $workerId);
            $this->db()->execute('insert into production_day_worker set production_day_id=:production_day_id, '
                . 'worker_id=:worker_id, hours=:hours, sollary=:sollary', [
                'production_day_id' => $productionDayId,
                'worker_id' => $workerId,
                'hours' => $day['hours'],
                'sollary' => $worker['sollary'],
            ]);
        }
    }

}
