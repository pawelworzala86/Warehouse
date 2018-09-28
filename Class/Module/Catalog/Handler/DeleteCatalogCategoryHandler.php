<?php

namespace App\Module\Catalog\Handler;

use App\Handler;
use App\Module\Catalog\Model\CategoryModel;
use App\Module\Catalog\Request\DeleteCatalogCategoryRequest;
use App\Response\SuccessResponse;

class DeleteCatalogCategoryHandler extends Handler
{

    public function __invoke(DeleteCatalogCategoryRequest $request): SuccessResponse
    {
        $categoryModel = new CategoryModel;

        $categoryModel->load($request->getId(), true);

        $categoryModel->delete();

        return new SuccessResponse;
    }

}