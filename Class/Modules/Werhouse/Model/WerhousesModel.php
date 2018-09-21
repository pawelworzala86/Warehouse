<?php

namespace App\Modules\Werhouse\Model;

use App\Model;
use App\Company;

class WerhousesModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getWerhouses($page)
    {
        $werhouse = $this->db()->getAll('select name, sys_unique_id, id '
            . 'from werhouse '
            . 'where company_id=?', Company::getId());
        return $werhouse;
    }

}
