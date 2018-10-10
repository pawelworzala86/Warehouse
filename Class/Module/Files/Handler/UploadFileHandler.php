<?php

namespace App\Module\Files\Handler;

use App\Handler;
use App\Module\Files\Request\UploadFileRequest;
use App\Module\Files\Response\UploadFileResponse;
use App\Container\FileResponse;
use App\Container\FilesResponse;

class UploadFileHandler extends Handler
{
    public function __invoke(UploadFileRequest $request): UploadFileResponse
    {
        $files = $request->getFile();
        $responseFiles = new FilesResponse;
        while ($file = $files->current()) {
            $file->save();
            $responseFiles->add(
                (new FileResponse)
                    ->setId($file->getUuid())
                    ->setUrl($file->getUrl())
                    ->setName($file->getName())
                    ->setType($file->getType())
                    ->setSize($file->getSize())
            );
            $files->next();
        }
        return (new UploadFileResponse)
            ->setFile($responseFiles);
    }
}