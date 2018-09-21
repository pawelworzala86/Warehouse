<?php

namespace App\Modules\Worker\Controller;

use App\Controller;
use App\Modules\Worker\Model\WorkersModel;

class Workers extends Controller {

    public function __construct() {
        $this->model = new WorkersModel;

        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'delete') {
                if ($this->checkPrivilage('worker-del')) {
                    $this->model->delete($_POST['id']);
                }
            } else if ($_POST['action'] == 'filter') {
                $this->model->filter();
            }
        }

        parent::__construct();
    }

    public function __invoke() {
        $this->assign('filter', $this->model->getFilter());
        $this->assign('workers', $this->model->getWorkers());
        $this->assign('deletePrivilage', $this->checkPrivilage('worker-del'));
        $this->assign('editPrivilage', $this->checkPrivilage('worker-edit'));
        $this->display('Worker/Workers');
    }

}
