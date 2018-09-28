<?php

namespace App\Module\Catalog\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Model\CategoryModel;
use App\Module\Catalog\Request\CreateCatalogCategoryRequest;
use App\Module\Catalog\Response\CreateCatalogCategoryResponse;
use App\User;

class CreateCatalogCategoryHandler extends Handler
{

    public function __invoke(CreateCatalogCategoryRequest $request): CreateCatalogCategoryResponse
    {
        $uuid = Common::getUuid();

        $categoryModel = new CategoryModel;
        $parentId = null;
        if($request->getParentId()) {
            $parentId = $categoryModel->load($request->getParentId(), true)->getId();
        }

        $lp = $categoryModel->getNewLp(User::getId(), $request->getParentId());

        $categoryModel = new CategoryModel;
        $categoryModel
            ->setUuid($uuid)
            ->setName($request->getName())
            ->setLp($lp)
            ->setCategoryId($parentId)
            ->insert();

        return (new CreateCatalogCategoryResponse)
            ->setId($uuid);
    }

}