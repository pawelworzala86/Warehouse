<?php

namespace App\Modules\Werhouse\Controller;

use App\Controller;
use App\Modules\Werhouse\Model\WerhouseAddModel;
use App\Modules\Document\Model\DocumentAddModel;
use App\Modules\Werhouse\Model\WerhouseProductsModel;

class WerhouseAdd extends Controller
{

    public $type;
    private $products;
    private $contractor;
    private $document;
    public $ids;

    public function __construct()
    {
        if (!isset($this->type)) {
            $this->type = 'add';
        }
        $this->ids = isset($_POST['id']) ? $_POST['id'] : null;

        if (isset($_POST['type'])) {
            $this->setProducts($this->getProducts());
            $this->setContractor($this->getContractor());
            $this->setDocument($this->getDocument());
            if (($this->checkPrivilage('werhouse-add')) && ($_POST['type'] == 'add')) {
                $this->werhouseAdd();
            } else if (($this->checkPrivilage('werhouse-dec')) && ($_POST['type'] == 'dec')) {
                $this->werhouseDec();
            }
        }

        parent::__construct();
    }

    public function setProducts($products)
    {
        $this->products = $products;
    }

    public function setContractor($contractor)
    {
        $this->contractor = $contractor;
    }

    public function setDocument($document)
    {
        $this->document = $document;
    }

    public function getProducts()
    {
        $products = [];
        if (isset($_POST['products'])) {
            foreach ($_POST['products'] as $product) {
                $products[] = [
                    'count' => (float)$product['count'],
                    'productId' => (string)$product['id'],
                    'net' => (float)$product['net'],
                    'tax' => (float)$product['tax'],
                    'gross' => (float)$product['gross'],
                ];
            }
        }
        return $products;
    }

    public function getContractor()
    {
        return [
            'sys_unique_id' => isset($_POST['contractor']) ? $_POST['contractor']['id'] : null,
        ];
    }

    public function getDocument()
    {
        return [
            'date_add' => isset($_POST['document']) ? $_POST['document']['date_add'] : null,
            'date_act' => isset($_POST['document']) ? $_POST['document']['date_act'] : null,
            'city' => isset($_POST['document']) ? $_POST['document']['city'] : null,
            'date_pay' => isset($_POST['document']) ? $_POST['document']['date_pay'] : null,
            'payment' => isset($_POST['document']) ? $_POST['document']['payment'] : null,
            'payed' => isset($_POST['document']) ? $_POST['document']['payed'] : null,
            'kind' => ($_POST['action'] == 'add') ? 'PZ' : 'WZ',
            'production_id' => null,
            'contractor_id' => isset($_POST['contractor_id']) ? $_POST['contractor_id'] : null,
        ];
    }

    public function werhouseAdd()
    {
        $ret = (new DocumentAddModel)
            ->products($this->products)
            ->contractor($this->contractor)
            ->document($this->document)
            ->add();

        (new WerhouseAddModel)
            ->products($ret['products'])
            ->add($ret['documentId']);

        $this->header('Location: /magazyn');
    }

    public function werhouseDec()
    {
        $this->products = (new WerhouseAddModel)
            ->products($this->products)
            ->dec();

        $documentId = (new DocumentAddModel)
            ->products($this->products)
            ->contractor($this->contractor)
            ->document($this->document)
            ->dec();

        $this->header('Location: /magazyn');
    }

    public function __invoke()
    {
        $document = [
            'date_add' => date("d-m-Y"),
            'date_act' => date("d-m-Y"),
            'city' => 'Elbląg',
            'date_pay' => date("d-m-Y"),
            'payment' => 'wire',
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
        $this->display('Werhouse/WerhouseAdd');
    }

}
