<?php

namespace App\Modules\Worker\Controller;

use App\Controller;
use App\Modules\Worker\Model\WorkerModel;

class Worker extends Controller {

    public function __construct() {
        $this->worker = new WorkerModel;

        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'edit') {
                if ($this->checkPrivilage('worker-edit')) {
                    $this->worker->setParams($_POST);
                    $this->worker->save();
                }
            }
        }

        parent::__construct();
    }

    public function __invoke($id = null) {
        $this->assign('worker', $this->worker->getWorker($id));
        $this->display('Worker/Worker');
    }

}
