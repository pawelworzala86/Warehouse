<?php

namespace App\Modules\Product\Controller;

use App\Controller;
use App\Modules\Product\Model\ProductImageDeleteModel;

class ProductImageDelete extends Controller {

    public function __construct() {
        $this->productImageDeleteModel = new ProductImageDeleteModel;

        $this->productImageDeleteModel->delete($_POST['id']);

        parent::__construct();
    }

    public function __invoke() {
    }

}
