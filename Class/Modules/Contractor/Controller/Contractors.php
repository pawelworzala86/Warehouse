<?php

namespace App\Modules\Contractor\Controller;

use App\Controller;
use App\Modules\Contractor\Model\ContractorsModel;

class Contractors extends Controller{
    
    public function __construct() {
        $this->model = new ContractorsModel;
        
        if(isset($_POST['action'])){
            if($_POST['action']=='delete'){
                if($this->checkPrivilage('contractor-del')){
                    $this->model->delete($_POST['id']);
                }
            }else if($_POST['action']=='filter'){
                $this->model->filter();
            }
        }
        
        parent::__construct();
    }

    public function __invoke($page = 1) {
        $this->assign('filter', $this->model->getFilter());
        $this->assign('contractors', $this->model->getContractors($page));
        $this->assign('deletePrivilage', $this->checkPrivilage('contractor-del'));
        $this->assign('editPrivilage', $this->checkPrivilage('contractor-edit'));
        $this->display('Contractor/Contractors');
    }
}
