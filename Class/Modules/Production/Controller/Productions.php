<?php

namespace App\Modules\Production\Controller;

use App\Controller;
use App\Modules\Production\Model\ProductionsModel;

class Productions extends Controller
{

    public function __construct()
    {
        $this->model = new ProductionsModel;

        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'delete') {
                if ($this->checkPrivilage('production-del')) {
                    $this->model->delete($_POST['sys_unique_id']);
                }
            } else if ($_POST['action'] == 'filter') {
                $this->model->filter();
            }
        }

        parent::__construct();
    }

    public function __invoke()
    {
        $this->assign('filter', $this->model->getFilter());
        $this->assign('productions', $this->model->getProductions());
        $this->assign('deletePrivilage', $this->checkPrivilage('production-del'));
        $this->assign('editPrivilage', $this->checkPrivilage('production-edit'));
        $this->assign('incomePrivilage', $this->checkPrivilage('production-income'));
        $this->assign('outcomePrivilage', $this->checkPrivilage('production-outcome'));
        $this->assign('workerPrivilage', $this->checkPrivilage('production-worker'));
        $this->display('Production/Productions');
    }

}
