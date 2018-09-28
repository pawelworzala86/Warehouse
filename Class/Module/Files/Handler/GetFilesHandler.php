<?php

namespace App\Module\Files\Handler;

use App\Handler;
use App\Module\Files\Collection\FileCollection;
use App\Module\Files\Request\GetFilesRequest;
use App\Module\Files\Response\GetFilesResponse;
use App\Type\FileResponse;
use App\Type\FilesResponse;
use App\Type\Filter;
use App\Type\FilterKind;
use App\User;

class GetFilesHandler extends Handler
{
    public function __invoke(GetFilesRequest $request): GetFilesResponse
    {
        $files = new FilesResponse;

        $filesCollection = new FileCollection;
        $filesCollection
            ->setPagination($request->getPagination())
            ->setFilters($request->getFilters())
            ->where(new Filter([
                'name' => 'added_by',
                'kind' => new FilterKind('='),
                'value' => User::getId(),
            ]))
            ->where(new Filter([
                'name' => 'deleted',
                'kind' => new FilterKind('null'),
                'value' => null,
            ]))
            ->load();

        while ($file = $filesCollection->current()) {
            $files->add(
                (new FileResponse)
                    ->setUrl($file->getUrl())
                    ->setName($file->getName())
                    ->setType($file->getType())
                    ->setId($file->getUuid())
                    ->setSize($file->getSize())
            );
            $filesCollection->next();
        }

        return (new GetFilesResponse)
            ->setPagination($filesCollection->getPagination())
            ->setFilters($filesCollection->getFilters())
            ->setFiles($files);
    }
}