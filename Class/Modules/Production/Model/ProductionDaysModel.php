<?php

namespace App\Modules\Production\Model;

use App\Model;
use App\User;
use App\Company;
use App\Common;

class ProductionDaysModel extends Model
{

    public function __construct()
    {
        parent::__construct();

        if (!isset($_SESSION['productions-days'])) {
            $this->filter(false);
        }
    }

    public function filter($notOverride = true)
    {
        $_SESSION['productions-days']['filter']['date'] = isset($_POST['date']) && $notOverride ? $_POST['date'] : null;
    }

    public function getFilter()
    {
        return $_SESSION['productions-days']['filter'];
    }

    public function getProductionDays($id)
    {
        $where = '';
        if (isset($_SESSION['productions-days']['filter']['date']) && !empty($_SESSION['productions-days']['filter']['date'])) {
            $where .= ' and from_unixtime(date,\'%d-%m-%Y\') = \'' . $_SESSION['productions-days']['filter']['date'] . '\' ';
        }
        $days = $this->db()->getAll('select *, '
            . '(sell_price-(cost+material_cost)) as revenue from  '
            . '(select sys_unique_id, id, '
            . 'from_unixtime(date,\'%d-%m-%Y\') as date,'
            . '(select sum(sollary*hours) from production_day_worker where production_day_id=production_day.id) as cost, '
            . '(select sum(buy_net*`count`) from document_product where '
            . 'exists(select 1 from document where type=\'dec\' and id=document_product.document_id and company_id=production_day.company_id and '
            . ' from_unixtime(date_add,\'%d-%m-%Y\')=from_unixtime(production_day.date,\'%d-%m-%Y\')) and company_id=production_day.company_id '
            .'and exists(select 1 from document where id=document_product.document_id and production_id=production_day.production_id)) as material_cost, '
            . '(select sum(sell_net*`count`) from document_product where '
            . 'exists(select 1 from document where type=\'add\' and id=document_product.document_id and company_id=production_day.company_id and '
            . ' from_unixtime(date_add,\'%d-%m-%Y\')=from_unixtime(production_day.date,\'%d-%m-%Y\')) and company_id=production_day.company_id '
            .'and exists(select 1 from document where id=document_product.document_id and production_id=production_day.production_id)) as sell_price '
            . 'from production_day '
            . 'where true ' . $where . ' and deleted is null and company_id=? and production_id=?) as x order by x.id desc', [
            Company::getId(),
            $this->db()->getOne('select id from production where sys_unique_id=?', $id)
        ]);

        foreach ($days as $key => $worker) {
            $worker['cost'] = number_format($worker['cost'], 2);
            $worker['material_cost'] = number_format($worker['material_cost'], 2);
            $worker['sell_price'] = number_format($worker['sell_price'], 2);
            $worker['revenue'] = number_format($worker['revenue'], 2);
            $days[$key] = $worker;
        }
        return $days;
    }

    public function delete($id)
    {
        return $this->db()->execute('update production_day set deleted=:deleted, user_id=:user_id where company_id=:company_id and sys_unique_id=:sys_unique_id', [
            'company_id' => Company::getId(),
            'user_id' => User::getId(),
            'sys_unique_id' => $id,
            'deleted' => time(),
        ]);
    }

    /*
      public function add($data) {
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
      } */
}
