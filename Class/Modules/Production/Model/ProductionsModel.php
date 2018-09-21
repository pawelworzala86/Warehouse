<?php

namespace App\Modules\Production\Model;

use App\Model;
use App\User;
use App\Company;

class ProductionsModel extends Model
{

    public function __construct()
    {
        parent::__construct();

        if (!isset($_SESSION['productions'])) {
            $this->filter(false);
        }
    }

    public function filter($notOverride = true)
    {
        $_SESSION['productions']['filter']['name'] = isset($_POST['name']) && $notOverride ? $_POST['name'] : null;
    }

    public function getFilter()
    {
        return $_SESSION['productions']['filter'];
    }

    public function getProductions()
    {
        $where = '';
        if (isset($_SESSION['productions']['filter']['name']) && !empty($_SESSION['productions']['filter']['name'])) {
            $where .= ' and name like \'%' . $_SESSION['productions']['filter']['name'] . '%\' ';
        }
        $production = $this->db()->getAll('select *, '
            . '(sell_price-(sollary_cost+material_cost)) as revenue from  '
            . '(select sys_unique_id, name, id, '
            . 'from_unixtime(date_start,\'%d-%m-%Y\') as date_start, from_unixtime(date_end,\'%d-%m-%Y\') as date_end, '
            . '(select sum(sollary*hours) from production_day_worker where '
            . 'exists(select 1 from production_day where production_day_id=id and production_id=production.id)) as sollary_cost, '
            . '(select sum(buy_net*`count`) from document_product where '
            . 'exists(select 1 from document where type=\'dec\' and id=document_product.document_id and company_id=production.company_id '
            . 'and production_id=production.id)) as material_cost, '
            . '(select sum(sell_net*`count`) from document_product where '
            . 'exists(select 1 from document where type=\'add\' and id=document_product.document_id and company_id=production.company_id  '
            . 'and production_id=production.id)) as sell_price '
            . ' from production where company_id=? ' . $where . ' and deleted is null) as x', Company::getId());
        foreach ($production as $key => $val) {
            $labels = [];
            $costData = [];
            $profitData = [];
            for ($i = 1; $i < 30; $i++) {
                $labels[] = $i;
                $costData[] = rand(10, 15);
                $profitData[] = rand(20, 25);
            }
            $val['labels'] = '[\'' . join('\',\'', $labels) . '\']';
            $val['cost']['data'] = '[' . join(',', $costData) . ']';
            $val['profit']['data'] = '[' . join(',', $profitData) . ']';

            $val['sollary_cost'] = number_format($val['sollary_cost'], 2);
            $val['material_cost'] = number_format($val['material_cost'], 2);
            $val['sell_price'] = number_format($val['sell_price'], 2);
            $val['revenue'] = number_format($val['revenue'], 2);

            $val['workers'] = [];
            $workers = $this->db()->getAll('select * from worker where '
                .'exists(select 1 from production_worker where worker.id=worker_id and production_id=?)', $val['id']);
            foreach ($workers as $worker) {
                $val['workers'][] = [
                    'name' => $worker['name'],
                ];
            }

            $production[$key] = $val;
        }
        return $production;
    }

    public function delete($id)
    {
        return $this->db()->execute('update production set deleted=:deleted, user_id=:user_id where company_id=:company_id and sys_unique_id=:sys_unique_id', [
            'company_id' => Company::getId(),
            'user_id' => User::getId(),
            'sys_unique_id' => $id,
            'deleted' => time(),
        ]);
    }

}
