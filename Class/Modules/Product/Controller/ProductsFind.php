<?php

namespace App\Modules\Product\Controller;

use App\Controller;
use App\Modules\Product\Model\ProductsFindModel;

class ProductsFind extends Controller
{

    public function __construct()
    {
        $this->model = new ProductsFindModel;

        parent::__construct();
    }

    public function __invoke()
    {
        $search = [];
        if (isset($_POST['search'])) {
            $search = $_POST['search'];
        }
        echo json_encode($this->model->getProducts($search, $_POST['countAdd'] === 'true', $_POST['intermediate'] === 'true'));
        exit;
    }
}
