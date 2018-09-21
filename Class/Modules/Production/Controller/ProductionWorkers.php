<?php

namespace App\Modules\Production\Controller;

use App\Controller;
use App\Modules\Production\Model\ProductionWorkersModel;
use App\Modules\Production\Model\ProductionModel;

class ProductionWorkers extends Controller {

    public function __construct() {
        $this->model = new ProductionWorkersModel;

        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'delete') {
                $this->model->delete($_POST['id']);
            } else if ($_POST['action'] == 'filter') {
                $this->model->filter();
            } else if ($_POST['action'] == 'add') {
                $this->model->add($_POST);
            }
        }

        parent::__construct();
    }

    public function __invoke($id) {
        $this->assign('id', $id);
        $this->assign('filter', $this->model->getFilter());
        $this->assign('workers', $this->model->getProductionWorkers($id));
        $this->assign('production', (new ProductionModel)->getProduction($id));
        $this->display('Production/ProductionWorkers');
    }

}
