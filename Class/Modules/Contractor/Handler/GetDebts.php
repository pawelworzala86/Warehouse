<?php

namespace App\Modules\Contractor\Handler;

use App\Handler;
use App\Modules\Contractor\Controller\DebtsController;
use App\Modules\Contractor\Request\GetDebtsRequest;
use App\Modules\Contractor\Response\GetDebtsResponse;

class GetDebts extends Handler{
    
    /*public function __construct(DebtsModel $debtsModel) {
        $this->debtsModel = $debtsModel;
        
        if(isset($_POST['action'])){
            if($_POST['action']=='filter'){
                $this->debtsModel->filter();
            }
        }
        
        parent::__construct();
    }*/

    public function __invoke(DebtsController $debts, GetDebtsRequest $request): GetDebtsResponse
    {
        //print_r($debtsModel);
        //$this->assign('filter', $debtsModel->getFilter());
        //$this->assign('contractors', $debtsModel->getContractors(1));
        //$this->display('Contractor/DebtsController');
        //$debts();
        return $debts->getDebts($request);
    }
}
