<?php

namespace App\Modules\Product\Controller;

use App\Controller;
use App\Modules\Product\Model\ProductsModel;

class Products extends Controller
{

    private $productsModel;

    public function __construct(ProductsModel $productsModel)
    {
        $this->productsModel = new ProductsModel;

        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'delete') {
                if ($this->checkPrivilage('product-del')) {
                    $this->productsModel->delete($_POST['id']);
                    exit;
                }
            } else if ($_POST['action'] == 'filter') {
                $this->productsModel->filter();
            }
        }

        parent::__construct();
    }

    public function __invoke($page = 1)
    {
        $this->assign('filter', $this->productsModel->getFilter());
        $this->assign('products', $this->productsModel->getProducts($page));
        $this->assign('deletePrivilage', $this->checkPrivilage('product-del'));
        $this->assign('editPrivilage', $this->checkPrivilage('product-edit'));
        $this->assign('fluentLoader', '/produkty');
        $this->display('Product/Products');
    }

}
