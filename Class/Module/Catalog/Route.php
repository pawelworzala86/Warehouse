<?php

namespace App\Module\Catalog;

use App\Router;
use App\Module\Catalog\Handler;

return [
    Router::post('/catalog/category', Handler\CreateCatalogCategoryHandler::class),
    Router::get('/catalog/category', Handler\GetCatalogCategoriesHandler::class),
    Router::put('/catalog/category/{id}', Handler\UpdateCatalogCategoryHandler::class),
    Router::delete('/catalog/category/{id}', Handler\DeleteCatalogCategoryHandler::class),

    Router::post('/catalog/product', Handler\CreateCatalogProductHandler::class),
    Router::get('/catalog/product', Handler\GetCatalogProductsHandler::class),
    Router::delete('/catalog/product/{id}', Handler\DeleteCatalogProductHandler::class),
    Router::post('/catalog/product/mass/delete', Handler\DeleteMassCatalogProductHandler::class),
    Router::post('/catalog/product/mass/xls', Handler\GetCatalogProductsXlsHandler::class),
    Router::get('/catalog/product/{id}', Handler\GetCatalogProductHandler::class),
    Router::put('/catalog/product/{id}', Handler\UpdateCatalogProductHandler::class),
    Router::get('/catalog/product/{id}/image', Handler\GetCatalogProductImagesHandler::class),
    Router::put('/catalog/product/{id}/image/{imageId}', Handler\AddImageToCatalogProductHandler::class),
];