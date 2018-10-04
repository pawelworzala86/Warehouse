<?php

namespace App\Module\Catalog\Handler;

use App\Handler;
use App\Module\Catalog\Collection\ProductAttachmentViewCollection;
use App\Module\Catalog\Request\GetCatalogProductAttachmentsRequest;
use App\Module\Catalog\Response\GetCatalogProductAttachmentsResponse;
use App\Type\FileResponse;
use App\Type\FilesResponse;
use App\Type\Filter;
use App\Type\FilterKind;

class GetCatalogProductAttachmentsHandler extends Handler
{
    public function __invoke(GetCatalogProductAttachmentsRequest $request): GetCatalogProductAttachmentsResponse
    {
        $filesCollection = new ProductAttachmentViewCollection;
        $filesCollection
            ->where(new Filter([
                'name' => 'deleted',
                'kind' => new FilterKind('='),
                'value' => 0,
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

        return (new GetCatalogProductAttachmentsResponse)
            ->setFiles($files);
    }
}