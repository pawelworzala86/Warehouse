<?php

namespace App\Module\Catalog\Handler;

use App\Handler;
use App\Module\Catalog\Collection\CategoryCollection;
use App\Module\Catalog\Response\GetCatalogCategoriesResponse;
use App\Request\EmptyRequest;
use App\Container\CatalogCategory;
use App\Container\CatalogCategorys;
use App\Container\Filter;
use App\Type\FilterKind;
use App\User;

class GetCatalogCategoriesHandler extends Handler
{

    public function __invoke(EmptyRequest $request): GetCatalogCategoriesResponse
    {
        $categoriesList = $this->getCategories();

        return (new GetCatalogCategoriesResponse)
            ->setCategories($categoriesList);
    }

    private function getCategories(int $categoryId = null)
    {
        $categoryCollection = (new CategoryCollection)
            ->where(new Filter([
                'name' => 'added_by',
                'kind' => new FilterKind('='),
                'value' => User::getId(),
            ]))
            ->where(new Filter([
                'name' => 'category_id',
                'kind' => $categoryId?new FilterKind('='):new FilterKind('null'),
                'value' => $categoryId,
            ]))
            ->where(new Filter([
                'name' => 'deleted',
                'kind' => new FilterKind('='),
                'value' => 0,
            ]))
            ->order('lp asc')
            ->load();

        $categoriesList = new CatalogCategorys;

        while ($category = $categoryCollection->current()) {
            $categoriesList->add(
                (new CatalogCategory)
                    ->setName($category->getName())
                    ->setId($category->getUuid())
                    ->setParentId($category->getCategoryUuid())
                    ->setCategories($this->getCategories($category->getId()))
            );
            $categoryCollection->next();
        }
        $categoriesList->rewind();

        return $categoriesList;
    }

}