<?php

namespace App\Module\Catalog\Handler;

use App\Handler;
use App\Module\Catalog\Collection\ProductFileViewCollection;
use App\Module\Catalog\Request\GetCatalogProductImagesRequest;
use App\Module\Catalog\Response\GetCatalogProductImagesResponse;
use App\Type\FileResponse;
use App\Type\FilesResponse;
use App\Type\Filter;
use App\Type\FilterKind;

class GetCatalogProductImagesHandler extends Handler
{
    public function __invoke(GetCatalogProductImagesRequest $request): GetCatalogProductImagesResponse
    {
        $filesCollection = new ProductFileViewCollection;
        $filesCollection
            ->where(new Filter([
                'name' => 'deleted',
                'kind' => new FilterKind('null'),
                'value' => null,
            ]))
            ->where(new Filter([
                'name' => 'product_uuid',
                'kind' => new FilterKind('='),
                'value' => hex2bin($request->getId()),
            ]))
            ->load();

        $files = new FilesResponse;
        while ($current = $filesCollection->current()) {
            $files->add(
                (new FileResponse)
                    ->setId($current->getFileUuid())
                    ->setName($current->getName())
                    ->setSize($current->getSize())
                    ->setUrl($current->getUrl())
                    ->setType($current->getType())
            );
            $filesCollection->next();
        }

        return (new GetCatalogProductImagesResponse)
            ->setFiles($files);
    }
}