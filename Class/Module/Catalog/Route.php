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
    Router::post('/catalog/product/search', Handler\GetSearchCatalogProductsHandler::class),
    Router::delete('/catalog/product/{id}', Handler\DeleteCatalogProductHandler::class),
    Router::post('/catalog/product/mass/delete', Handler\DeleteMassCatalogProductHandler::class),
    Router::post('/catalog/product/mass/xls', Handler\GetCatalogProductsXlsHandler::class),
    Router::post('/catalog/product/mass/pdf', Handler\GetCatalogProductsPdfHandler::class),
    Router::get('/catalog/product/{id}', Handler\GetCatalogProductHandler::class),
    Router::put('/catalog/product/{id}', Handler\UpdateCatalogProductHandler::class),
    Router::get('/catalog/product/{id}/image', Handler\GetCatalogProductImagesHandler::class),
    Router::get('/catalog/product/{id}/attachment', Handler\GetCatalogProductAttachmentsHandler::class),
    Router::put('/catalog/product/{id}/image/{imageId}', Handler\AddImageToCatalogProductHandler::class),
    Router::put('/catalog/product/{id}/attachment/{fileId}', Handler\AddAttachmentToCatalogProductHandler::class),
    Router::delete('/catalog/product/{id}/image/{imageId}', Handler\DeleteImageFromCatalogProductHandler::class),
    Router::delete('/catalog/product/{id}/attachment/{fileId}', Handler\DeleteAttachmentFromCatalogProductHandler::class),
];