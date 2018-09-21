<?php

namespace App\Modules\Production\Controller;

use App\Controller;
use App\Modules\Werhouse\Model\WerhouseAddModel;
use App\Modules\Document\Model\DocumentAddModel;
use App\Modules\Production\Model\ProductionModel;

class ProductionOutCome extends Controller {

    private $type;
    private $products;
    private $document;

    public function __construct() {
        $this->type = 'dec';

        if (isset($_POST['action'])) {
            $this->setProducts($this->getProducts());
            $this->setDocument($this->getDocument());
            if (($this->checkPrivilage('werhouse-add')) && ($_POST['action'] == 'add')) {
                $this->werhouseAdd();
            } else if (($this->checkPrivilage('werhouse-dec')) && ($_POST['action'] == 'dec')) {
                $this->werhouseDec();
            }
        }

        parent::__construct();
    }

    public function setProducts($products) {
        $this->products = $products;
    }

    public function setDocument($document) {
        $this->document = $document;
    }

    public function getProducts() {
        $products = [];
        if (isset($_POST['product'])) {
            foreach ($_POST['product'] as $product) {
                $products[] = [
                    'count' => (float) $product['count'],
                    'productId' => (string) $product['id'],
                ];
            }
        }
        return $products;
    }

    public function getDocument() {
        return [
            'date_add' => date("d-m-Y"),
            'date_act' => date("d-m-Y"),
            'city' => 'Elbląg',
            'date_pay' => date("d-m-Y"),
            'payment' => 'none',
            'payed' => '',
            'kind' => ($_POST['action'] == 'dec') ? 'RW' : 'PW',
            'production_id' => $_POST['id'],
        ];
    }

    public function werhouseAdd() {
        $ret = (new DocumentAddModel)
                ->products($this->products)
                ->document($this->document)
                ->add();

        (new WerhouseAddModel)
                ->products($ret['products'])
                ->add($ret['documentId']);

        header('Location: /produkcje');
    }

    public function werhouseDec() {
        $this->products = (new WerhouseAddModel)
                ->products($this->products)
                ->dec();

        $documentId = (new DocumentAddModel)
                ->products($this->products)
                ->document($this->document)
                ->dec();

        header('Location: /produkcje');
    }

    public function __invoke($id) {
        $this->assign('type', $this->type);
        $this->assign('id', $id);
        $this->assign('production', (new ProductionModel)->getProduction($id));
        $this->display('Production/ProductionOutCome');
    }

}
