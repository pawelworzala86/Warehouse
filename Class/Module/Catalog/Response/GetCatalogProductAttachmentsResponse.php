<?php

namespace App\Module\Catalog\Response;

use App\Response\Response;
use App\Container\FileResponse;
use App\Container\FilesResponse;

class GetCatalogProductAttachmentsResponse extends Response
{
    public $fieldClass = FileResponse::class;

    private $files;

    function setFiles(FilesResponse $files): GetCatalogProductAttachmentsResponse
    {
        $this->files = $files;
        return $this;
    }

    function getFiles(): FilesResponse
    {
        return $this->files;
    }
}