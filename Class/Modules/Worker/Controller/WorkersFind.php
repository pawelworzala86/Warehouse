<?php

namespace App\Modules\Worker\Controller;

use App\Controller;
use App\Modules\Worker\Model\WorkersFindModel;

class WorkersFind extends Controller{
    
    public function __construct() {
        $this->model = new WorkersFindModel;
        
        parent::__construct();
    }

    public function __invoke() {
        $search = '';
        if(isset($_POST['search'])){
            $search = $_POST['search'];
        }
        echo json_encode($this->model->getWorkers($search));
        exit;
    }
}
