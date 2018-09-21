<?php

namespace App\Modules\Contractor\Controller;

use App\Controller;
use App\Modules\Contractor\Model\DebtsModel;
use App\Modules\Contractor\Request\GetDebtsRequest;
use App\Modules\Contractor\Response\GetDebtsResponse;
use App\Types\DebtsContractor;
use App\Types\DebtsContractors;
use App\Types\DebtsDocument;
use App\Types\DebtsDocuments;

class DebtsController extends Controller
{

    /*public function __construct()
    {
        $this->debtsModel = new DebtsModel;

        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'filter') {
                $this->debtsModel->filter();
            }
        }

        parent::__construct();
    }

    public function __invoke($page = 1)
    {
        $this->assign('filter', $this->debtsModel->getFilter());
        $this->assign('contractors', $this->debtsModel->getContractors($page));
        $this->display('Contractor/DebtsController');
    }*/

    public function getDebts(GetDebtsRequest $request): GetDebtsResponse
    {
        $debtsModel = new DebtsModel;
        $debts = $debtsModel->getContractors(1);

        $contractors = new DebtsContractors;
        foreach ($debts as $debt) {
            $documents = new DebtsDocuments;
            foreach ($debt['documents'] as $document) {
                $documents->add(
                    (new DebtsDocument)
                        ->setPayed($document['payed'])
                        ->setNumber($document['number'])
                        ->setDateAdd($document['date_add'])
                        ->setDatePay($document['date_pay'])
                        ->setDebt($document['debt'])
                );
            }
            $contractors->add(
                (new DebtsContractor)
                    ->setNip($debt['nip'])
                    ->setMail($debt['mail'])
                    ->setCode($debt['code'])
                    ->setId($debt['sys_unique_id'])
                    ->setName($debt['name'])
                    ->setDebt($debt['debt'])
                    ->setDocuments($documents)
            );
        }

        return (new GetDebtsResponse)
            ->setContractors($contractors);
    }
}
