<?php

namespace App\Modules\Werhouse\Controller;

use App\Modules\Document\Model\DocumentAddModel;
use App\Controller;

class WerhouseSell extends WerhouseAdd
{

    public function __construct()
    {
        $this->type = 'dec';
        parent::__construct();
        /*$this->type = 'dec';
        $this->ids = isset($_POST['id']) ? $_POST['id'] : null;

        if (isset($_POST['action'])) {
            $this->setProducts($this->getProducts());
            $this->setContractor($this->getContractor());
            $this->setDocument($this->getDocument());

            $this->werhouseDec();
            (new DocumentAddModel)
                ->document($this->getDocument())
                ->contractor($this->getDocument())
                ->products($this->getProducts())
                ->add();
        }*/
    }

    public function getDocument()
    {
        return [
            'contractor_id' => isset($_POST['contractor_id']) ? $_POST['contractor_id'] : null,
            'date_add' => isset($_POST['document']) ? $_POST['document']['date_add'] : null,
            'date_act' => isset($_POST['document']) ? $_POST['document']['date_act'] : null,
            'city' => isset($_POST['document']) ? $_POST['document']['city'] : null,
            'date_pay' => isset($_POST['document']) ? $_POST['document']['date_pay'] : null,
            'payment' => isset($_POST['document']) ? $_POST['document']['payment'] : null,
            'payed' => isset($_POST['document']) ? $_POST['document']['payed'] : null,
            'kind' => 'FV',
            'production_id' => null,
        ];
    }

}
