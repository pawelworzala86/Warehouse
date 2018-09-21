<?php

namespace App\Modules\Werhouse\Controller;

use App\Modules\Document\Model\DocumentAddModel;
use App\Modules\Werhouse\Model\WerhouseProductsModel;
use App\Werhouse;

class Reservation extends WerhouseAdd
{

    public function __construct()
    {
        $this->type = 'dec';
        parent::__construct();
    }

    public function werhouseDec()
    {
        /*$this->setProducts((new WerhouseAddModel)
            ->products($this->getProducts())
            ->dec());*/

        $documentId = (new DocumentAddModel)
            ->products($this->getProducts())
            ->contractor($this->getContractor())
            ->document($this->getDocument())
            ->dec();

        $this->header('Location: /rezerwacje');
    }

    public function getDocument()
    {
        return [
            'date_add' => date("d-m-Y"),
            'date_act' => date("d-m-Y"),
            'city' => 'Elbląg',
            'date_pay' => date("d-m-Y"),
            'payment' => 'none',
            'payed' => 0,
            'kind' => 'REZ',
            'production_id' => null,
            'contractor_id' => isset($_POST['contractor_id']) ? $_POST['contractor_id'] : null,
            'werhouse_id'=>Werhouse::getId(),
        ];
    }

    public function __invoke()
    {
        $document = [
            'date_add' => date("d-m-Y"),
            'date_act' => date("d-m-Y"),
            'city' => 'Elbląg',
            'date_pay' => date("d-m-Y"),
            'payment' => 'none',
            'payed' => '',
        ];
        $this->assign('type', $this->type);
        $this->assign('document', $document);
        if (isset($this->ids)) {
            $this->assign('products', (new WerhouseProductsModel)->getProducts($this->ids));
            $this->assign('productsList', (new WerhouseProductsModel)->getProductsString($this->ids));
        } else {
            $this->assign('products', []);
            $this->assign('productsList', false);
        }
        $this->display('Werhouse/Werhouse');
    }

}
