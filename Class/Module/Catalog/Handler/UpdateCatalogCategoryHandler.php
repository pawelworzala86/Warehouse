<?php

namespace App\Module\Catalog\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Model\CategoryModel;
use App\Module\Catalog\Request\UpdateCatalogCategoryRequest;
use App\Response\SuccessResponse;
use App\User;

class UpdateCatalogCategoryHandler extends Handler
{

    public function __invoke(UpdateCatalogCategoryRequest $request): SuccessResponse
    {
        $categoryModel = new CategoryModel;
        $categoryId = null;
        if ($request->getParentId()) {
            $categoryModel->load($request->getParentId(), true);
            $categoryId = $categoryModel->getId();
        }

        $categoryModel = new CategoryModel;
        $categoryModel->load($request->getId(), true);
        $id = $categoryModel->getId();
        $oldCategoryId = $categoryModel->getCategoryId();

        if ($request->getLp()) {
            $categoryModel->moveLp(User::getId(), $request->getLp());
        }

        (new CategoryModel)
            ->setId($id)
            ->setLp($request->getLp())
            ->setName($request->getName())
            ->setCategoryId($categoryId)
            ->update();

        $categoryModel->repairLps($oldCategoryId);
        $categoryModel->repairLps($categoryId);

        return new SuccessResponse;
    }

}